<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangeEmailRequest;
use App\Models\ChangeEmail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * ログイン後：メールアドレス変更 コントローラー
 */
class ChangeEmailController extends Controller
{
    /**
     * メールアドレス変更ページ 描画
     *
     * @return void
     */
    public function show()
    {
        return view('user.change_email');
    }

    /**
     * メールアドレス変更メール 送信処理
     *
     * @param ChangeEmailRequest $request メールアドレス変更 リクエストクラス
     */
    public function sendEmail(ChangeEmailRequest $request)
    {
        $token = Hash::make($request->new_email);
        DB::beginTransaction();
        try {
            $change_email = ChangeEmail::create([
                'user_id' => auth()->user()->id,
                'new_email' => $request->new_email,
                'token' => $token,
            ]);
            DB::commit();
            $encoded_token = base64_encode($token);
            $change_email->sendEmailResetNotification($encoded_token);
            return redirect()->route('top')->with('message', '確認メールを送信しました。ご確認ください。※まだ、メールアドレスの変更は完了していません。');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('top')->with('message', 'メールアドレスの変更に失敗しました。');
        }
    }
}
