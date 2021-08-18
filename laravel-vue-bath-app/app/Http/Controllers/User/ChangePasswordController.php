<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Hash;

/**
 * ログイン後：パスワード変更 コントローラー
 */
class ChangePasswordController extends Controller
{
    /** ユーザー サービス */
    private $userService;

    /**
     * コンストラクタ
     *
     * @param CodeNameService $codeNameService コード名称サービスのインスタンス
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * パスワード変更ぺージ 描画
     *
     * @return void
     */
    public function show()
    {
        return view('user.change_password');
    }

    /**
     * パスワード変更処理
     *
     * @param ChangePasswordRequest $request パスワード変更 リクエストクラス
     * @return void
     */
    public function submit(ChangePasswordRequest $request)
    {
        $this->userService->updateUser([ 'password' => Hash::make($request->new_password) ]);
        return redirect()->route('user.mypage')->with('message', 'パスワードを変更しました。');
    }
}
