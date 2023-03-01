<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|string|max:50',
            'email' => 'required|email|unique:users,email'.$this->route('user'),
            // 'email'  => [
            //         'required',
            //         'email',
            //         Rule::unique('users','email')->ignore($this->route('user')),
            //     ],
            'roles'  => 'nullable|string|in:ADMIN,USER'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Tidak Boleh Kosong !',
            'email.required' => 'Email Tidak Boleh Kosong !',
        ];
    }
}
