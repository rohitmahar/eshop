<?php

namespace App\Http\Controllers\Frontend;

use App\Eshop\Repositories\SettingRepository;
use App\Http\Requests\SendContactEmail;
use App\Mail\ContactEmailSend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

/**
 * Class ContactController
 * @package App\Http\Controllers\Frontend
 */
class ContactController extends Controller
{
    /**
     * @var SettingRepository
     */
    protected $setting;

    /**
     * ContactController constructor.
     * @param SettingRepository $setting
     */
    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }
    /**
     * return to the contact page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('users.contact');
    }
    
    /**
     * @param SendContactEmail $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMail(SendContactEmail $request)
    {
        $email = new ContactEmailSend($request->all());
        Mail::to($this->setting->find(1)->email)->queue($email);
        
        return redirect()->back()->with('message', 'Your Message Sent successfully');
    }
}
