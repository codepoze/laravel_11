<?php

namespace App\Http;

use App\Http\Middleware\AuthenticateSessionMiddleware;
use App\Http\Middleware\RedirectIfAuthenticatedMiddleware;
use App\Http\Middleware\PreventBackHistoryMiddleware;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class AppMiddleware
{
    public function __invoke(Middleware $middleware)
    {
        $middleware->alias([
            'guest'                => RedirectIfAuthenticatedMiddleware::class,
            'auth.session'         => AuthenticateSessionMiddleware::class,
            'prevent.back.history' => PreventBackHistoryMiddleware::class,
            'role'                 => RoleMiddleware::class,
            'permission'           => PermissionMiddleware::class,
            'role_or_permission'   => RoleOrPermissionMiddleware::class,  
        ]);

        $middleware->append([
            \Fahlisaputra\Minify\Middleware\MinifyHtml::class,
            \Fahlisaputra\Minify\Middleware\MinifyCss::class,
            \Fahlisaputra\Minify\Middleware\MinifyJavascript::class,
        ]);
    }
}
