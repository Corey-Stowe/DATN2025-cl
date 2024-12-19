<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Kiểm tra role: 1 là admin
            if (Auth::user()->roles_id !== 15) {
              //logout immediately
                Auth::logout();
                return redirect()->route('showForm')->with([
                    'Error' => 'Bạn phải đăng nhập trước'
                ]);
            } else {
                return $next($request); // Tiếp tục với request nếu là admin
                // Điều hướng về trang user nếu không phải admin

            }
        } else {
            // Nếu chưa đăng nhập, điều hướng về trang login
            return redirect()->route('showForm')->with([
                'Error' => 'Bạn phải đăng nhập trước'
            ]);
        }
    }
}
