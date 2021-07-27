<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
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