<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }


public function register(RegisterRequest $request)
{
    Log::info('Start user registration', ['input' => $request->all()]);

    // Create user
    $user = User::create([
        'name'      => $request->first_name . " " . $request->last_name,
        'email'     => $request->email,
        'phone'     => $request->phone,
        'home_address' => $request->home_address,
        'password'  => Hash::make($request->password),
        'type'      => 'customer'
    ]);

    Log::info('User created', ['user_id' => $user->id]);

    Auth::login($user);

    Log::info('User logged in', ['user_id' => $user->id]);

    return redirect()->route('login.form');
}


 public function login(Request $request)
    {
          $credentials = $request->only('email', 'password');
          $remember = $request->filled('remember');

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = $request->user();

          
            $token = $user->createToken('web-token')->plainTextToken;

            // التوجيه بناءً على الرول
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('token', $token);
            } else {
                return redirect()->route('customer.dashboard')->with('token', $token);
            }
        }

        return back()->with('error', 'بيانات الدخول غير صحيحة!');
    }
    public function adminDashboard()
        {
        
            $categories = Category::all();

            return view('admin.dashboard', compact('categories'));
        }
      public function customerDashboard()
    {
        return view('customer.dashboard');
    }

 public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login.form');
}

}
