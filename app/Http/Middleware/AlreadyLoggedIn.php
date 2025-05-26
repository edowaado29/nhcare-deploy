<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session()->has('loginId') && (url('login') == $request->url())){
            return back()->with('fail','Anda harus logout terlebih dahulu.');
        }
        if(Session()->has('loginId') && (url('index') == $request->url())){
            return back()->with('fail','Anda harus logout terlebih dahulu.');
        }
        if(Session()->has('loginId') && (url('forgot_password') == $request->url())){
            return back()->with('fail','Anda harus logout terlebih dahulu.');
        }
        if(Session()->has('loginId') && (url('validasi_forgot_password') == $request->url())){
            return back()->with('fail','Anda harus logout terlebih dahulu.');
        }
        return $next($request);
    }
}
