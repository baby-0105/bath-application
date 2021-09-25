<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
     * @param LoginRequest $request リクエストインスタンス
     * @return str ログイン可 / 不可　メッセージ
     */
    public function login(LoginRequest $request)
    {
        $this->setCredentials($request);
        if (Auth::attempt($this->credentials)) {
            $request->session()->regenerate();
            $request->session()->flash('message', 'ログインが完了しました。');
            return view('top');
        }

        $validator = [
            'error' => 'メールアドレス、もしくは、パスワードが異なります。',
        ];
        return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * クレデンシャル情報をセット
     *
     * @param LoginRequest $request
     */
    private function setCredentials(LoginRequest $request):void
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
        return view('top');
    }
}
