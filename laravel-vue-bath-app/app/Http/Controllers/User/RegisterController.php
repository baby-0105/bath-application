<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Register;
use App\Http\Service\User\RegisterService;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(RegisterService $register_service)
    {
        $this->middleware('guest');
        $this->register_service = $register_service;
    }

    /**
     * 新規登録と、メール送信
     *
     * @param Register $request
     * @return void
     */
    public function sendAndCreate(Register $request)
    {
        $valueObject = $request->toValueObject();
        $this->register_service->sendAndCreate($valueObject);

        $data = [
            'email' => $request->email
        ];
        return view('user.check_email')->with($data);
    }

    /**
     * 本登録完了ページ
     *
     * @param [type] $email_token
     * @return void
     */
    public function showVerify($token)
    {
        $data = [
            'canUseToken'  => $this->register_service->canUseToken($token),
            'verifiedUser' => $this->register_service->verifiedUser($token),
            'updatedUser'  => $this->register_service->updatedUser($token),
        ];

        // トークン無効
        if (!$data['canUseToken']) {
            return view('user.verify')->with('message', '無効なトークンです。');
        }
        // 本登録済み
        if ($data['verifiedUser']) {
            return view('user.verify')->with('message', 'すでに本登録完了しているユーザーです。ログインして利用してください。');
        }

        if($data['updatedUser']) {
            $token_arr =[
                "email_verify_token" => base64_decode($token)
            ];
            return view('user.verify', $token_arr);
        } else{
            return view('user.verify')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
        }
    }
}
