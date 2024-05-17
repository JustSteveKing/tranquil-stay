<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

final class GuestMiddleware extends Authenticate
{
    protected function redirectTo(Request $request): string
    {
        return route('pages:auth:login');
    }
}
