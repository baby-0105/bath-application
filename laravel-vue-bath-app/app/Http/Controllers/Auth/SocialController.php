<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SocialRequest;
use App\Mail\UserSnsRegisterMailSent;
use App\Models\User;
use App\Services\User\SocialService;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * SNS認証用 コントローラー
 */
class SocialController extends Controller
{

    /** SNS認証 サービス */
    private $socialService;

    /**
     * コンストラクタ
     *
     * @param SocialService $socialService SNS認証サービス インスタンス
     * @return void
     */
    public function __construct(
        SocialService $socialService
    )
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
            if(auth()->user()) { return redirect()->route('top')->with('message', 'すでにログイン済みです。'); }
            $user = Socialite::driver($sns)->stateless()->user(); // stateless()：セッションでのstateのnullエラー防止
            $data = [
                'nonVerify' => $this->socialService->isNonVerify(session('name')),
                'selectAuthUser' => $this->socialService->selectAuthUser($user, $sns)
            ];
            // DBカラ → セッション保存
            if(empty($data['selectAuthUser'])) {
                session([
                    'register.sns_id' => $user->id,
                    'register.sns' => $sns,
                    'register.name' => $user->name,
                    'register.email' => $user->email,
                ]);
                return redirect()->route('top')->with('snsUpdateProfile', '認証が完了しました')->with($data);
            }
            // ログイン（snsカラム一致時）
            else if ($this->socialService->matchConfirmation($user, $sns)) {
                $this->socialService->toLoginUser($user, $sns);
                return redirect()->route('top')->with('message', 'ログインしました');
            }
            return redirect()->route('top')->with('message', '認証が完了しました')->with($data);
        }
        catch (Exception $e) {
            return redirect()->route('user.login')->with('message', '認証ができませんでした。');
        }
    }

    /**
     * 認証後、modalでユーザー情報登録 / 確認メール送信 / ログイン
     *
     * @param SocialRequest $request SNS認証リクエスト インスタンス
     * @return json
     */
    public function updateProfile(SocialRequest $request)
    {
        $sns = DB::transaction(function () use ($request) {
            $sns = session('register');
            $user = new User([
                'name'   => $request->name,
                'email'  => $request->email,
                'sns_id' => $sns['sns_id'],
                'sns'    => $sns['sns'],
                'status' => config('const.USER_STATUS.REGISTER'),
            ]);
            $user->save();

            $user->user_info()->create([ 'is_release' => true ]);
            return $sns;
        });
        Mail::to($request->email)->send(new UserSnsRegisterMailSent($request->name));
        Auth::login($this->socialService->getSnsAuthUser($sns['sns_id'], $sns['sns']));
        return response()->json(['message' => route('top')]);
    }
}
