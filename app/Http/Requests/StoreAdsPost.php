<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsPost extends FormRequest
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
    public function rules(){
        // dd(request()->input());

        return [
            'a_name'=>[
                'required',
                'regex:/^[\x7f-\xff]|[a-zA-Z0-9]{3,15}$/',
                Rule::unique('ads')->ignore(request()->a_id,'a_id'),

            ],
            'a_key'=>'required',
            'a_text'=>'required',

        ];
    }
    public function messages(){
        return[
            'a_name.required'=>'公告标题不能为空',
            'a_name.regex'=>'公告标题长度为3-15位,由数字、字母、汉子组成',
            'a_name.unique'=>'该公告标题已存在',

            'a_key.required'=>'关键词不能为空',
            'a_text.required'=>'公告内容不能为空',

        ];
    }
}
