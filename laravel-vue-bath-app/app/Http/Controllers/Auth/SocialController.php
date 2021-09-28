<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SocialRequest;
use App\Mail\UserSnsRegisterMailSent;
use App\Models\User;
use App\Services\User\SocialService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Socialite;
use Exception;

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
            if(auth()->user()) {
                Session::flash('message', 'すでにログイン済みです。');
                return view('top');
            }

            $user = Socialite::driver($sns)->stateless()->user(); // stateless()：セッションでのstateのnullエラー防止
            session([
                'register.sns_id' => $user->id,
                'register.sns' => $sns,
                'register.name' => $user->name,
                'register.email' => $user->email,
                'register.nonVerify' => $this->socialService->isNonVerify(session('name')),
                'register.selectAuthUser' => $this->socialService->selectAuthUser($user, $sns)
            ]);

            // ユーザー登録モーダル表示
            if(empty($this->socialService->selectAuthUser($user, $sns))) {
                Session::flash('snsUpdateProfile', '認証が完了しました');
                return view('top');
            }

            // ログイン処理（snsカラム一致時）
            else if ($this->socialService->matchConfirmation($user, $sns)) {
                $this->socialService->toLoginUser($user->id, $sns);
                Session::flash('message', $user->name.'さん、ようこそOFLogへ。');
                return view('top');
            }
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
        $this->socialService->toLoginUser($sns['sns_id'], $sns['sns']);
        return response()->json(['message' => route('top')]);
    }
}
