<?php

namespace App\Http\Controllers\Backend;

use App\Eshop\Repositories\SettingRepository;
use App\Http\Requests\SettingUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SettingController
 * @package App\Http\Controllers\Backend
 */
class SettingController extends Controller
{
    /**
     * @var SettingRepository
     */
    protected $setting;

    /**
     * SettingController constructor.
     * @param SettingRepository $setting
     */
    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $setting = $this->setting->find(1);

        return view('backend.setting.index', compact('setting'));
    }

    /**
     * @param $id
     * @param SettingUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, SettingUpdateRequest $request)
    {
        $setting = $this->setting->find($id);
        
        $this->setting->update($request, $setting);
        return redirect()->back()->with('message', 'Setting is updated Successfully');
    }
}
