<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... other properties

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // Add your custom middleware here:
        'admin.guest' => \App\Http\Middleware\RedirectIfAdminAuthenticated::class,
        'admin.auth' => \App\Http\Middleware\AuthenticateAdmin::class,
        'teacher.auth' => \App\Http\Middleware\TeacherAuth::class,
        'teacher.guest' => \App\Http\Middleware\TeacherGuest::class,
    ];
}