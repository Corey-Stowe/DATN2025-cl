<?php

namespace App\Http\Middleware;

use App\Models\Wallet;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckVaildUserWallet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
          $wallet = new Wallet();
          $userid = Auth::user()->id;
          $walletcheck = $wallet->getWallet($userid);
          if ($walletcheck) {
            return $next($request);
          }
          else {
                return redirect()->route("ekyc.index");
            }
        }

        return redirect()->route('showForm');
    }
}
