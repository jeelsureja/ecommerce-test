<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $route = Route::currentRouteName();

        if($route == 'user-register') {
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6',
            ];
        } elseif($route == 'verify-login') {
            return [
                'email' => 'required|exists:users,email,deleted_at,NULL',
                'password' => 'required|min:6',
            ];
        } else {
            return [

            ];
        }

    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(redirect()->back()->withErrors($validator)->withInput());
    }
}
