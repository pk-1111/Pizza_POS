<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // not login -> login | register -> open


        // login -> login | register -> close

       if( Auth::user()){  // when user stay login
                       if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' ){

                        // user call login and register page when he login , reject url request

            if($request->route()->getName() == 'login' || $request->route()->getName() == 'register'){
               return back();
            }

            // user call all request excepts login and register url
              return $next($request);
        }

        return back();

       }else{

        //  when user not login , can call login and register routem
                 return $next($request);
       }
    }
}
