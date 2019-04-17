<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsersPost extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        // dd(request()->input());
        return [
            'user_name' => [
                'required',
                'max:15',
                'min:2',
                'regex:/^[a-zA-Z0-9_-]{4,16}$/',
                Rule::unique('user')->ignore(request()->user_id,'user_id'),
            ],
            'user_pwd'=>'sometimes|required|min:6|max:12|alpha_dash',
            'user_pawd'=>'sometimes|required|same:user_pwd',
            'user_email'=>'required|email',
            'user_tel'=>'required|regex:/^1[34578][0-9]{9}$/',
        ];
    }
    public function messages(){
        return[
            'user_name.required'=>'用户名不能为空',
            'user_name.unique'=>'用户名已存在',
            'user_name.max'=>'用户名最大长度不能超过15',
            'user_name.min'=>'用户名最小长度为2',
            'user_name.regex'=>'用户名用格式为数字字母下划线',

            'user_pwd.required'=>'密码不能为空',
            'user_pwd.max'=>'用户名最大长度不能超过6',
            'user_pwd.min'=>'用户名最小长度为2',
            'user_pwd.alpha_dash'=>"密码格式为数字字母下划线",

            'user_pawd.required'=>'确认密码不能为空',
            'user_pawd.same'=>'密码和确认密码不一致',

            'user_email.required'=>'邮箱不能为空',
            'user_email.email'=>'邮箱格式不正确',

            'user_tel.regex'=>'电话格式不正确',
            'user_tel.required'=>'电话不能为空',

        ];
    }
}

?>
