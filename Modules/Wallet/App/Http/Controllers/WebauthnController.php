<?php

namespace Modules\Wallet\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Webautn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Webauthn\PublicKeyCredentialRequestOptions;
use Webauthn\AuthenticatorAssertionResponseValidator;
use Webauthn\PublicKeyCredentialSourceRepository;
use Cose\Algorithm\Manager as AlgorithmManager;
use Cose\Algorithm\ManagerFactory;
class WebauthnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicKey = [
            'challenge' => base64_encode(random_bytes(32)), // Thay bằng giá trị thực tế
            'rp' => [
                'name' => config('app.name'),
            ],
            'user' => [
                'id' => base64_encode(Auth::user()->id),
                'name' => Auth::user()->email,
                'displayName' => Auth::user()->name,
            ],
            'pubKeyCredParams' => [
                ['type' => 'public-key', 'alg' => -7], // ES256
            ],
        ];
        return view('wallet::webauthn.register', compact('publicKey'));
    }
    public function store(Request $request)
    {
        $webautndata = [
            'user_id' => Auth::user()->id,
            'credentialId' => $request->id,
            'type' => $request->type,
            'credentialPublicKey' => $request->rawId,
            'counter' => '0',
            'name' => $request->name,
            'transports' => $request->response['clientDataJSON'],
            'aaguid' => $request->response['attestationObject'],
            'attestationType' => 'newkey',
            'trustPath' => "trustPath",
        ];
        $webauthn = new Webautn($webautndata);
        $keys = $webauthn->getUserKey(Auth::user()->id);

        if ($keys->isNotEmpty()) {
            return response()->json(['error' => 'Khóa của bạn đã được đăng ký và không thể thay đổi'], 400);
        } else {
            try {
                $webauthn->CreateAuthKey($webautndata);
                return response()->json(['callback' => route('wallet.profile')]);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }


    public function login()
    {
        $publicKey = [
            'challenge' => base64_encode(random_bytes(32)), // Thay bằng giá trị thực tế
            'rp' => [
                'name' => config('app.name'),
            ],
            'user' => [
                'id' => base64_encode(Auth::user()->id),
                'name' => Auth::user()->email,
                'displayName' => Auth::user()->name,
            ],
            'pubKeyCredParams' => [
                ['type' => 'public-key', 'alg' => -7], // ES256
            ],
        ];
        return view('wallet::webauthn.login', compact('publicKey'));
    }

    public function checkvar(Request $request)
    {
        // Lấy các khóa đã đăng ký cho người dùng
        $webauthn = new Webautn();
        $keys = $webauthn->getUserKey(Auth::user()->id);

        if (isset($request->id)) {
            if ($request->rawId === $keys->first()->credentialPublicKey) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false]);
        }
    }



    public function forgetkey(Request $request){
     $webauthn = new Webautn();
     $webauthn->deletekey(Auth::user()->id);
    }

    public function updatekey(Request $request){
        $webautndata = [
            'credentialId' => $request->id,
            'type' => $request->type,
            'credentialPublicKey' => $request->rawId,
            'counter' => '0',
            'name' => $request->name,
            'transports' => $request->response['clientDataJSON'],
            'aaguid' => $request->response['attestationObject'],
            'attestationType' => 'newkey',
            'trustPath' => "trustPath",
        ];
        $webauthn = new Webautn($webautndata);
        try {
            $webauthn->updateKey( Auth::user()->id,$webautndata);
            return back()->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
           dd($e->getMessage());
        }
    }

    public function action(Request $request){
        if($request->filled('enable')){
            $webauthn = new Webautn();
            $data = $webauthn->getUserKey(Auth::user()->id);
            if($data->isNotEmpty()){
                return back()->with('error','Khóa của bạn đã được đăng ký và không thể thay đổi');
            } else {
                return  redirect()->route('wallet.webautn.index');
            }
        } else {
            try{
                $webauthn = new Webautn();
                $data =  $webauthn->deletekey(Auth::user()->id);
                return back()->with('success','Đã hủy kích hoạt OTPless+');

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        }
    }
}
