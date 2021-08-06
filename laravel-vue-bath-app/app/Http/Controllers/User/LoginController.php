<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Login;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン処理
     *
     * @param Login $request
     * @return array
     */
    public function login(Login $request)
    {
        $this->setCredentials($request);
        if (Auth::attempt($this->credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('flash_message', 'ログインが完了しました。');
        }

        $validator = [
            'error' => 'メールアドレス、もしくは、パスワードが異なります。',
        ];
        return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * クレデンシャル情報をセット
     *
     * @param Login $request
     */
    private function setCredentials(Login $request):void
    {
        $this->credentials = [
            'email'     => $request->input('email', null),
            'password'  => $request->input('password', null),
        ];
    }

    /**
     * ログアウト
     *
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
