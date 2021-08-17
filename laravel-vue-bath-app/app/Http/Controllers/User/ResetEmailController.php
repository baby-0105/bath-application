<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\ChangeEmailService;
use App\Services\User\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * メールアドレスリセット コントローラー
 */
class ResetEmailController extends Controller
{
    private $changeEmailService; /** メールアドレス変更 サービス */
    private $userService; /** ユーザー サービス */

    /**
     * コンストラクタ
     *
     * @param ChangeEmailService $changeEmailService メールアドレス変更 サービス
     * @param UserService $userService ユーザーサービス
     * @return void
     */
    public function __construct(
        ChangeEmailService $changeEmailService,
        UserService $userService
    )
    {
        $this->changeEmailService = $changeEmailService;
        $this->userService = $userService;
    }

    /**
     * メールアドレスリセット処理
     *
     * @param Request $request リクエスト インスタンス
     * @param string $encodedToken エンコードされたトークン
     * @return void
     */
    public function reset(Request $request, $encodedToken)
    {
        $changeEmail = $this->changeEmailService->getChangeEmail(base64_decode($encodedToken));

        // トークンが存在している、かつ、有効期限が切れていないかチェック
        if($changeEmail && !$this->tokenExpired($changeEmail->created_at)) {
            $this->userService->updateUser([ 'email' => $changeEmail->new_email ]);
            $changeEmail->delete();
            return redirect()->route('top')->with('message', 'メールアドレスを更新しました。');
        } else {
            if($changeEmail) { $changeEmail->delete(); }
            return redirect()->route('top')->with('message', 'メールアドレスの更新に失敗しました。');
        }

    }

    /**
     * トークンが有効期限切れかどうかチェック
     *
     * @param  string  $createdAt
     * @return bool
     */
    private function tokenExpired($createdAt)
    {
        $expires = 60 * 60; // トークンの有効期限は60分
        return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
    }
}
