<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * SNS認証 リクエストクラス
 */
class SocialRequest extends FormRequest
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
     * ユーザー登録リクエストに適用するバリデーションルールを取得
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'string', 'unique:users', 'min:2', 'max:20'],
            'email' => ['bail', 'required', 'string', 'unique:users', 'email:rfc']
        ];
    }

    /**
     * 属性定義
     *
     * @return array
     */
    public function attributes()
    {
        return[
            'name'     => 'ユーザー名',
            'email'    => 'メールアドレス',
        ];
    }
}
