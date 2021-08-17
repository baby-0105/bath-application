<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ログイン後：メールアドレス変更 リクエストクラス
 */
class ChangeEmailRequest extends FormRequest
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
            'new_email' => ['bail', 'required', 'string', 'email:rfc', 'unique:users,email'],
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
            'new_email' => '新しいメールアドレス',
        ];
    }
}
