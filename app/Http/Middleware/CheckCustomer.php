<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCustomer
{
    public function handle($request, Closure $next)
    {
       
        if (! Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $user = Auth::user();

        if ($user->type !== 'customer') {
            abort(403, 'Unauthorized');
        }

        if (! $user->is_active) {
            Auth::logout();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Your account has been disabled. Please contact support.'
                ]);
        }

        return $next($request);
    }
}
