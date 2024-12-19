<?php

namespace Modules\Client\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerificationController extends Controller
{
    public function verify(Request $request, $id)
    {   
        // dd($request);
        if (!$request->hasValidSignature()) {
            abort(403, 'Link xác nhận không hợp lệ hoặc đã hết hạn.');
        }

        $user = User::findOrFail($id);
        
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('index')->with('status', 'Email đã được xác nhận.');
        }

        $user->markEmailAsVerified();
        $user->status = 'active';
        $user->save();

        return redirect()->route('index')->with('status', 'Xác nhận email thành công.');
    }
}
