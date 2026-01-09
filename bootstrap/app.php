<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

     
        then: function () {
            require base_path('routes/admin.php');
            require base_path('routes/customer.php');
        }
    )
->withMiddleware(function (Middleware $middleware): void {
    
    $middleware->appendToGroup('api', [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    ]);
  
    $middleware->group('admin', [
        \Illuminate\Session\Middleware\StartSession::class,
        \App\Http\Middleware\CheckAdmin::class,
    ]);

      $middleware->group('customer', [
        \Illuminate\Session\Middleware\StartSession::class,
        \App\Http\Middleware\CheckCustomer::class,
    ]);


     $middleware->alias([
        'role' => \App\Http\Middleware\CheckAdmin::class,
         'customerRole' => \App\Http\Middleware\CheckCustomer::class,
     ]);
 
})

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
