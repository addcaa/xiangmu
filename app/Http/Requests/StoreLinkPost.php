<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLinkPost extends FormRequest
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
        // dd(request()->input());
        return [
            'l_URL'=>[
                'required',
                Rule::unique('Links')->ignore(request()->l_id,'l_id'),

            ],
            'l_website'=>[
                'required',
                'regex:/^((https|http|ftp|rtsp|mms){0,1}(:\/\/){0,1})www\.(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/',
            ],
            'l_name'=>[
                'required',

            ],
        ];
    }
    public function messages(){
        return[
            'l_URL.required'=>'网址名称不能为空',
            'l_URL.unique'=>'网址名称已存在',

            'l_website.regex'=>'格式应该以http://开头',
            'l_website.required'=>'网站网址不能为空',

            'l_name.required'=>'网站联系人不能为空',


        ];
    }
}
