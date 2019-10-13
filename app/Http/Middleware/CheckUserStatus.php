<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->isBanned()) {
              auth()->logout();
              $message = 'You have been banned';
              return redirect()->route('login')->with('error-message',trans('login.banned'));
            }
        }
        return $next($request);
      }
}
