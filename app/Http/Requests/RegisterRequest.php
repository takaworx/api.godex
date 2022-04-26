<?php

namespace App\Http\Requests;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->user()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:16',
            'last_name' => 'required|string|max:16',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
