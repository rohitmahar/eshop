<?php

namespace App\Http\Controllers\Auth\OAuth;

use App\Eshop\Services\OAuth\SocialAccountService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;

class FacebookOAuthController extends Controller
{
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @param SocialAccountService $socialAccountService
     *
     * @return Response
     */
    public function handleProviderCallback(SocialAccountService $socialAccountService)
    {
        $user = $socialAccountService->createOrGetUser(Socialite::driver('facebook')->user(),'google');

        auth()->login($user);

        return redirect()->to('/homepage');
    }
}
