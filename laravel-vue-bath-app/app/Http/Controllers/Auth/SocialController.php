<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\User\RegisterService;
use App\Service\User\SocialService;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Exception;

/**
 * SNS認証用 コントローラー
 */
class SocialController extends Controller
{

    private $socialService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    /**
     * SNSの認証ページへ
     *
     * @param [type] $sns
     * @return void
     */
    public function redirectToProvider($sns)
    {
        return Socialite::driver($sns)->redirect();
    }

    /**
     * ユーザーのSNS情報を入手→認証
     *
     * @param [type] $sns
     * @return void
     */
    public function handleProviderCallback($sns)
    {
        try {
            // 既にログイン済み
            if(Auth::user()) { return redirect()->route('top'); }

            $user = Socialite::driver($sns)->stateless()->user(); // stateless()：セッションでのstateのnullエラー防止
            $data = [
                'name'   => $user->name,
                'email'  => $user->email,
                'sns_id' => $user->id,
                'sns'    => $sns,
                'status' => config('const.USER_STATUS.REGISTER'),
                'selectAuthUser'    => $this->socialService->selectAuthUser($user, $sns),
            ];
            // DBカラ → 新規登録
            if(empty($data['selectAuthUser'])) {
                User::create($data);
                return redirect()->route('top')->with('snsUpdateProfile', '認証が完了しました');
            }
            // ログイン：snsカラム一致時
            else if ($this->socialService->matchConfirmation($user, $sns)) {
                $this->socialService->toLoginUser($user, $sns);
                return redirect()->route('top');
            }
            return redirect()->route('top')->with('snsUpdateProfile', '認証が完了しました');
        }

        catch (Exception $e) {
            return redirect()->route('user.login')->with('snsErrorMessage', '認証ができませんでした。');
        }

    }
}
