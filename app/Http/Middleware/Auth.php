<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use Exception;

class Auth {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $user = User::loggedInUser();

        if (!$user || $user->role->slug !== 'admin') {
            return response()->view('login');
        }

        return $next($request);
    }
}
