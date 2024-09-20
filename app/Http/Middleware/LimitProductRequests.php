<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests;

class LimitProductRequests extends ThrottleRequests
{
    protected function resolveRequestSignature($request)
    {
        return sha1($request->method().$request->fullUrl());
    }
}