<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * ログイン後：パスワード変更 リクエストクラス
 */
class ChangePasswordRequest extends FormRequest
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
            'current_password' => [
                'bail', 'required',
                function ($attribute, $value, $fail) {
                    $current_password = auth()->user()->password;
                    if(!Hash::check($value, $current_password)) {
                        $fail('現在のパスワードが違います');
                    }
                },
            ],
            'new_password' => [
                'bail', 'required', 'string', 'min:8', 'max:16',
                'regex:/^[!-~]+$/', 'confirmed',
            ],
        ];
    }


    /**
     * 属性定義
     *
     */
    public function attributes()
    {
        return [
            'current_password' => '現在のパスワード',
            'new_password' => '新しいパスワード',
        ];
    }
}
