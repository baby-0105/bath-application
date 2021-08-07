<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SocialRequest;
use App\Mail\UserSnsRegisterMailSent;
use App\Models\User;
use App\Service\User\SocialService;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Exception;
use Illuminate\Support\Facades\Mail;

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
            if(Auth::user()) { return redirect()->route('top')->with('is_auth', 'すでにログイン済みです。'); }

            $user = Socialite::driver($sns)->stateless()->user(); // stateless()：セッションでのstateのnullエラー防止

            $data = [
                'nonVerify' => User::where('name', session('name'))->value('status') !== config('const.USER_STATUS.REGISTER'),
                'selectAuthUser' =>$this->socialService->selectAuthUser($user, $sns)
            ];
            // DBカラ → 新規登録
            if(empty($data['selectAuthUser'])) {
                session(['register.sns_id' => $user->id, 'register.sns' => $sns]);
                return redirect()->route('top')->with('snsUpdateProfile', '認証が完了しました')->with($data);
            }
            // ログイン：snsカラム一致時
            else if ($this->socialService->matchConfirmation($user, $sns)) {
                $this->socialService->toLoginUser($user, $sns);
                return redirect()->route('top')->with('is_auth', 'ログインしました');
            }
            return redirect()->route('top')->with('is_auth', '認証が完了しました')->with($data);
        }

        catch (Exception $e) {
            return redirect()->route('user.login')->with('authError', '認証ができませんでした。');
        }
    }

    /**
     * 認証後、modalでユーザー情報登録
     *
     * @return json
     */
    public function updateProfile(SocialRequest $request)
    {
        // SNSでのユーザー登録
        $sns = session('register');
        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'sns_id' => $sns['sns_id'],
            'sns'    => $sns['sns'],
            'status' => config('const.USER_STATUS.REGISTER'),
        ];
        User::create($data);

        // 登録メール送信
        Mail::to($request->email)->send(new UserSnsRegisterMailSent($request->name));

        $authUser = User::where('sns_id', $sns['sns_id'])->where('sns', $sns['sns'])->first();
		Auth::login($authUser);
        return redirect()->route('top')->with('is_auth', '認証が完了しました');
    }
}
