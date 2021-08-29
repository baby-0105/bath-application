<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * My投稿 並び替え リクエストクラス
 */
class SelectOrderRequest extends FormRequest
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
            'selectOrder' => ['bail', 'required'],
        ];
    }

    /**
     * 属性定義
     *
     */
    public function attributes()
    {
        return [
            'selectOrder' => '選択欄',
        ];
    }
}
