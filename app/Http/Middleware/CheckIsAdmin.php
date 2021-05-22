<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        //dd($user->AdminMode());
        if (!$user ->AdminMode()) {
            session()->flash('warning', 'У вас нет прав администратора');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
