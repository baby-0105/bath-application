<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ChangeEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * メールアドレスリセット コントローラー
 */
class ResetEmailController extends Controller
{
    public function reset(Request $request, $encoded_token)
    {
        $decoded_token = base64_decode($encoded_token);
        $change_email = ChangeEmail::where('token', $decoded_token)->first();

        // トークンが存在している、かつ、有効期限が切れていないかチェック
        if($change_email && !$this->tokenExpired($change_email->created_at)) {
            User::where('id', auth()->user()->id)
                ->update([ 'email' => $change_email->new_email ]);

            $change_email->delete();
            return redirect()->route('top')->with('message', 'メールアドレスを更新しました。');
        } else {
            if($change_email) {
                $change_email->delete();
            }
            return redirect()->route('top')->with('message', 'メールアドレスの更新に失敗しました。');
        }

    }

    /**
     * トークンが有効期限切れかどうかチェック
     *
     * @param  string  $createdAt
     * @return bool
     */
    protected function tokenExpired($createdAt)
    {
        $expires = 60 * 60; // トークンの有効期限は60分
        return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
    }
}
