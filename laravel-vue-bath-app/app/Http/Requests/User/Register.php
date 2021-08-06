<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * ユーザーがこのリクエストの権限を持っているかを判断する
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
            'name'     => 'required|string|min:2|max:20|unique:users',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|max:16|regex:/^[!-~]+$/|confirmed',
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
            'password' => 'パスワード',
        ];
    }

    /**
     * 入力された内容の変換
     *
     * @return array
     */
    public function toValueObject()
    {
        return [
            'name'               => $this->input('name'),
            'email'              => $this->input('email'),
            'password'           => $this->input('password'),
            'status'             => config('const.USER_STATUS.PRE_REGISTER'),
            'email_verify_token' => $this->input('email'),
        ];
    }
}
