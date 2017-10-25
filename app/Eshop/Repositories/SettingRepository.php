<?php

namespace App\Eshop\Repositories;

use App\Eshop\Models\Setting;
use App\Http\Requests\SettingUpdateRequest;

/**
 * Class SettingRepository
 * @package App\Eshop\Repositories
 */
class SettingRepository 
{
    /**
     * @var Setting
     */
    protected $setting;

    /**
     * SettingRepository constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * update the existing records of setting table.
     * 
     * @param SettingUpdateRequest $request
     * @param $setting
     * @return Collection
     */
    public function update(SettingUpdateRequest $request, $setting)
    {
        return $setting->fill($request->all())->save();
    }

    /**
     * find the setting object from setting Id.
     * 
     * @param $settingId
     * @return Object
     */
    public function find($settingId) 
    {
        return $this->setting->find($settingId);
    }
}