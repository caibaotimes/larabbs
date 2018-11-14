<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

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
            'name'=>'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.Auth::id(),
            'email'=>'required|email',
            'introduction'=>'max:80',
            'avatar'=>'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes'=>'头像必须是JPEG，bmp，陪你过，gif格式的图片',
            'avatar.dimenions'=>'图片的清晰度不够，宽和高需要200px以上',
            'name.unique'=>'用户名已被占用,请重新填写',
            'name.regex'=>'用户名只支持英文、数字、横杆和下划线。',
            'name.between'=>'用户名必须介于3-25个字符之间。',
            'name.required'=>'用户名不能空。',
        ];
    }
}
