<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * ユーザー情報編集　リクエストクラス
 */
class EditRequest extends FormRequest
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
     * バリーデーションのためにデータを準備
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // 現在のアイコン画像から変更なしの場合
        if(empty($this->icon_path) && isset($this->current_icon_path)) {
            $this->icon_path = $this->current_icon_path;
            $this->is_change = false;
        } else {
            $this->is_change = true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'string', 'min:2', 'max:20',  Rule::unique('users')->ignore(auth()->user()->id, 'id')],
            'icon_path' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'prefecture' => ['bail', 'nullable', 'exists:code_names,code,group_key,PREFECTURE'],
            'introduce' => ['bail', 'nullable', 'string', 'max:160', 'regex:/^[^#<>^;_]*$/'],
            'is_release' => ['bail', 'required', 'exists:code_names,code,group_key,IS_RELEASE'],
        ];
    }

    /**
     * 属性定義
     *
     */
    public function attributes()
    {
        return [
            'icon_path' => 'プロフィール画像',
            'introduce' => '自己紹介',
            'is_release' => '公開設定',
        ];
    }

    /**
     * アップロードした画像パスを保存する
     *
     * @return string 画像パス
     */
    public function saveUploadImagePath()
    {
        $iconPath = null;
        // 現在のアイコン画像を更新したかどうか
        if($this->is_change) {
            $iconImg = $this->file('icon_path');
            if($iconImg) { $iconPath = $iconImg->store('uploads', 'public'); }
            return $iconPath;
        } else {
            $iconPath = $this->icon_path;
            return $iconPath;
        }
    }
}
