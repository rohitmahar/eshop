<?php

namespace App\Http\Controllers\Frontend;

use App\Eshop\Repositories\ProfileSettingRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\ProfileUpdateRequest;

/**
 * manage the customer profile.
 * 
 * Class ProfileSettingController
 * @package App\Http\Controllers\Frontend
 */
class ProfileSettingController extends Controller
{
    /**
     * currently logged in user.
     * 
     * @var ProfileSettingRepository
     */
    protected $currentUser;

    /**
     * ProfileSettingController constructor.
     * @param ProfileSettingRepository $currentUser
     */
    public function __construct(ProfileSettingRepository $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    /**
     * user's profile setting page.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting()
    {
        return view('users.profile.setting');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchase()
    {
        return view('users.profile.purchase');
    }

    /**
     * update the user profile.
     *
     * @param ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $this->currentUser->profileUpdate($request);

        return redirect()->route('profile.setting')->with('message', 'Your Profile Updated Successfully');
    }

    /**
     * reset customer password.
     *
     * @param PasswordResetRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordReset(PasswordResetRequest $request)
    {
        $this->currentUser->passwordReset($request);
        
        return redirect()->route('profile.setting')->with('message', 'Password Updated Successfully');
    }
}
