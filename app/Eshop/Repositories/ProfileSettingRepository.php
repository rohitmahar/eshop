<?php

namespace App\Eshop\Repositories;

use App\Eshop\Repositories\Backend\ProductRepository;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\ProfileUpdateRequest;

/**
 * manage the customer profile.
 *
 * Class ProfileSettingRepository
 * @package App\Eshop\Repositories
 */
class ProfileSettingRepository
{
    /**
     * @var OrderRepository
     */
    private $order;

    /**
     * ProfileSettingRepository constructor.
     * @param OrderRepository $order
     */
    public function __construct(OrderRepository $order)
    {

        $this->order = $order;
    }

    /**
     * update general information of customer.
     *
     * @param ProfileUpdateRequest $request
     * @return Boolean
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        return $user->save();
    }
    
    /**
     * reset password of customer.
     *
     * @param PasswordResetRequest $request
     * @return Boolean
     */
    public function passwordReset(PasswordResetRequest $request)
    {
        $user = auth()->user();
        $user->password = bcrypt($request->password);
        return $user->save();
    }
}