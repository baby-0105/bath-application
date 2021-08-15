<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * ログイン後：パスワード変更 コントローラー
 */
class ChangePasswordController extends Controller
{
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
        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        return redirect()->route('user.mypage')->with('is_change_password', 'パスワードを変更しました。');
    }
}
