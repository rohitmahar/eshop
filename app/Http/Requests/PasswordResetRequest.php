<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class PasswordResetRequest
 * @package App\Http\Requests
 */
class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Hash::check($this->old_password, auth()->user()->password)) {
            return true;
        }
        return redirect()->route('profile.setting')->with('error', 'Current Password do not Match !');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '_token' => 'required',
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
