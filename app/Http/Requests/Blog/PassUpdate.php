<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class PassUpdate extends FormRequest
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
            'password'=>'min:6|max:20|confirmed|required',
        ];
    }

    public function messages()
    {
        return[
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能少于6位',
            'password.max'=>'密码最大不能超过20个',
            'password.confirmed'=>'两次密码不一致',
            ];
    }

}
