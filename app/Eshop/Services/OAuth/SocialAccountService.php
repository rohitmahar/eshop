<?php

namespace App\Eshop\Services\OAuth;

use App\Eshop\Models\SocialAccount;
use App\Eshop\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

/**
 * Class SocialAccountService
 * @package app\Eshop\Services\OAuth
 */
class SocialAccountService
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var SocialAccount
     */
    private $socialAccount;

    /**
     * SocialAccountService constructor.
     *
     * @param User          $user
     * @param SocialAccount $socialAccount
     */
    public function __construct(User $user, SocialAccount $socialAccount)
    {
        $this->user          = $user;
        $this->socialAccount = $socialAccount;
    }

    /**
     * Return user if already exist or create new one otherwise
     *
     * @param ProviderUser $providerUser
     * @param              $provider
     *
     * @return User
     */
    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        $account = $this->socialAccount->whereProvider($provider)
                                       ->whereProviderUserId($providerUser->getId())
                                       ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount(
                [
                    'provider_user_id' => $providerUser->getId(),
                    'provider'         => $provider,
                ]
            );

            $user = $this->user->whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = $this->user->create(
                    [
                        'email' => $providerUser->getEmail(),
                        'name'  => $providerUser->getName(),
                    ]
                );
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}