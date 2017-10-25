<?php

namespace App\Http\ViewComposers;

use App\Eshop\Repositories\SettingRepository;
use Illuminate\View\View;

/**
 * Class SettingComposer
 * @package App\Http\ViewComposers
 */
class SettingComposer
{
    /**
     * @var SettingRepository
     */
    protected $setting;

    /**
     * SettingComposer constructor.
     * @param SettingRepository $setting
     */
    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('setting', $this->setting->find(1));
    }
}