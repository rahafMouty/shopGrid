<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
public function generateDescription($id)
{
    $product = \App\Models\Product::findOrFail($id);
    $apiKey = env('GEMINI_API_KEY');

    try {
        // خطوة 1: جلب الموديلات المتاحة لهذا المفتاح تحديداً
        $modelsUrl = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;
        $modelsResponse = \Illuminate\Support\Facades\Http::withoutVerifying()->get($modelsUrl);
        $modelsData = $modelsResponse->json();

        // ابحث عن أول موديل متاح يدعم توليد المحتوى (مثل gemini-1.5-flash أو gemini-pro)
        $availableModel = null;
        if (isset($modelsData['models'])) {
            foreach ($modelsData['models'] as $model) {
                if (in_array('generateContent', $model['supportedGenerationMethods'])) {
                    $availableModel = $model['name']; // سيأتي بصيغة models/gemini-1.5-flash
                    break;
                }
            }
        }

        if (!$availableModel) {
            return response()->json([
                'success' => false, 
                'message' => 'No supported models found for this API Key. Check your Google AI Studio quota.',
                'debug' => $modelsData
            ], 404);
        }

        // خطوة 2: استخدام الموديل الذي وجدناه فعلياً
        $generateUrl = "https://generativelanguage.googleapis.com/v1beta/{$availableModel}:generateContent?key=" . $apiKey;

        $response = \Illuminate\Support\Facades\Http::withoutVerifying()
            ->timeout(60)
            ->post($generateUrl, [
                'contents' => [['parts' => [['text' => "Write a professional marketing description for: " . $product->name]]]]
            ]);

        $data = $response->json();

        if ($response->successful()) {
            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if ($text) {
                $product->ai_description = $text;
                $product->save();
                return response()->json(['success' => true, 'description' => $text, 'model_used' => $availableModel]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Generation failed.', 'debug' => $data], 500);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
}

// تابع احتياطي في حال فشل الموديل الأول
private function fallbackGeneration($product, $apiKey) {
    $fallbackUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=" . $apiKey;
    
    $response = \Illuminate\Support\Facades\Http::withoutVerifying()->post($fallbackUrl, [
        'contents' => [['parts' => [['text' => "Write a description for: " . $product->name]]]]
    ]);
    
    $data = $response->json();
    $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

    if ($text) {
        $product->update(['ai_description' => $text]);
        return response()->json(['success' => true, 'description' => $text]);
    }

    return response()->json(['success' => false, 'message' => 'All models failed. Check your API Console.', 'debug' => $data], 404);
}
}