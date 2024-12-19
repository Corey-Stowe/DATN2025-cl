<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;

// class CheckAdminMiddleware
// {

//     public function handle(Request $request, Closure $next): Response
//     {
//         if (Auth::check()) {
//             if (Auth::user()->roles_id === 1) {
//                 return $next($request);
//             } else {
//                 // Điều hướng về trang dành cho người dùng thông thường hoặc trang lỗi
//                 return redirect()->route('homeClient')->with('message', 'Bạn không có quyền truy cập trang này.');
//             }
//         }
//     }
// }


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Kiểm tra role: 1 là admin
            if (Auth::user()->roles_id == 15) {
                return redirect()->route('index')->with([
                    'message' => 'Bạn không có quyền truy cập trang này'
                ]);
            } else {
                return $next($request); // Tiếp tục với request nếu là admin
                // Điều hướng về trang user nếu không phải admin

            }
        } else {
            // Nếu chưa đăng nhập, điều hướng về trang login
            return redirect()->route('login.admin')->with([
                'message' => 'Bạn phải đăng nhập trước'
            ]);
        }
    }
}

