<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [

    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [

        ],

        'api' => [

        ],
    ];

    protected $routeMiddleware = [
        'RedirectIfAuthenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
}
