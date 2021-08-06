<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Login;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

/**
 * ログインコントローラー
 */
class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * ログイン後のリダイレクト先
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * コンストラクタ
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
     * @param Login $request リクエストインスタンス
     * @return str ログイン可 / 不可　メッセージ
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
     * ログアウト処理
     *
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
