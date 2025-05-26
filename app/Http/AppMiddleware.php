<?php

namespace App\Http;

use App\Http\Middleware\AuthenticateSessionMiddleware;
use App\Http\Middleware\RedirectIfAuthenticatedMiddleware;
use App\Http\Middleware\PreventBackHistoryMiddleware;
use Illuminate\Foundation\Configuration\Middleware;

class AppMiddleware
{
    public function __invoke(Middleware $middleware)
    {
        $middleware->alias([
            'guest'                => RedirectIfAuthenticatedMiddleware::class,
            'auth.session'         => AuthenticateSessionMiddleware::class,
            'prevent.back.history' => PreventBackHistoryMiddleware::class,
        ]);

        $middleware->append([]);
    }
}
