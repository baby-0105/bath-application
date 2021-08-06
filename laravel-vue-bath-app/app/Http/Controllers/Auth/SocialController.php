<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

/**
 * SNS認証用 コントローラー
 */
class SocialController extends Controller
{
    /**
     * Googleへリダイレクト
     *
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google認証：登録 or ログイン
     *
     *
     */
    public function handleGoogleCallback()
    {
        $gUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $gUser->email)->first();

        if($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }

        // ログイン処理
        Auth::login($user, true);
        return redirect('/');
    }

    /**
     * Google認証でユーザー作成
     *
     * @return array
     */
    public function createUserByGoogle($gUser)
    {
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => Hash::make($gUser->password),
        ]);
        return $user;
    }

    /**
     * Facebookへリダイレクト
     *
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Facebook認証：登録 or ログイン
     *
     * @return Response
     */
    public function handleFacebookProviderCallback()
    {
        try{
            $user = Socialite::driver('facebook')->stateless()->user(); // stateless()：セッションでのstateのnullエラー防止

            if($user){
                $token = $user->token;
                $refreshToken = $user->refreshToken;
                $expiresIn = $user->expiresIn;

                $user->getId();
                $user->getNickname();
                $user->getName();
                $user->getEmail();
                $user->getAvatar();

            }
        }catch(Exception $e){
            return redirect("/");
        }

        // $user->token;
    }
}
