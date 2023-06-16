<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $response['msg'] ='Token invalido, o indefinido, consulte con su adminstrador';
        $response['status'] = 401;
        abort(response()->json($response, 401));
        return  $request->expectsJson() ? response()->json(['error' => 'Unauthenticated.'], 401) : route('login');
    }
}
