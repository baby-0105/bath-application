<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * お風呂投稿 リクエストクラス
 */
class ToPostRequest extends FormRequest
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
            'title' => ['bail', 'required', 'string', 'max:30', 'regex:/^[^#<>^;_]*$/'],
            'eval' => ['bail', 'required', 'exists:code_names,code,group_key,EVAL'],
            'hot_water_eval' => ['bail', 'nullable', 'exists:code_names,code,group_key,EVAL'],
            'rock_eval' => ['bail', 'nullable', 'exists:code_names,code,group_key,EVAL'],
            'sauna_eval' => ['bail', 'nullable', 'exists:code_names,code,group_key,EVAL'],
            'thoughts' => ['bail', 'nullable', 'string', 'max:240', 'regex:/^[^#<>^;_]*$/'],
            'main_img' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'sub1_img' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'sub2_img' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'sub3_img' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ];
    }

    /**
     * メイン画像がアップロードされているかのチェック
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(empty($this->main_img) && isset($this->sub1_img)) {
                $validator->errors()->add('sub1_img', 'メイン画像無しでは、サブ画像1のアップロードは出来ません。');
            }
            if(empty($this->main_img) && isset($this->sub2_img)) {
                $validator->errors()->add('sub2_img', 'メイン画像無しでは、サブ画像2のアップロードは出来ません。');
            }
            if(empty($this->main_img) && isset($this->sub3_img)) {
                $validator->errors()->add('sub3_img', 'メイン画像無しでは、サブ画像3のアップロードは出来ません。');
            }
        });
    }

    /**
     * 属性定義
     *
     */
    public function attributes()
    {
        return [
            'title' => 'お風呂名',
            'eval' => '全体評価',
            'hot_water_eval' => 'お湯評価',
            'rock_eval' => '岩盤浴評価',
            'sauna_eval' => 'サウナ評価',
            'thoughts' => '感想',
            'main_img' => 'メイン画像',
            'sub1_img' => 'サブ1画像',
            'sub2_img' => 'サブ2画像',
            'sub3_img' => 'サブ3画像',
        ];
    }

    /**
     * アップロードした画像パスを保存する
     *
     * @return array 画像パス
     */
    public function saveUploadImagePath()
    {
        $mainPath = null;
        $sub1Path = null;
        $sub2Path = null;
        $sub3Path = null;

        $mainImg = $this->file('main_img');
        $sub1Img = $this->file('sub1_img');
        $sub2Img = $this->file('sub2_img');
        $sub3Img = $this->file('sub3_img');

        if($mainImg) { $mainPath = $mainImg->store('uploads', 'public'); }
        if($sub1Img) { $sub1Path = $sub1Img->store('uploads', 'public'); }
        if($sub2Img) { $sub2Path = $sub2Img->store('uploads', 'public'); }
        if($sub3Img) { $sub3Path = $sub3Img->store('uploads', 'public'); }

        return [
            'mainPath' => $mainPath,
            'sub1Path' => $sub1Path,
            'sub2Path' => $sub2Path,
            'sub3Path' => $sub3Path,
        ];
    }
}
