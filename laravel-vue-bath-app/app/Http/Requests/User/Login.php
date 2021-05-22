<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Login extends FormRequest
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
            'email'    => 'required',
            'password' => 'required',
        ];
    }

    /**
     * ログイン確認
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator) {
        // 本登録済みかどうか
        $validator->after(function ($validator) {
            $data = [
                'notFilled' => !$this->filled(['password']) || !$this->filled(['email']),
                'preRegister' => User::query()->where('email', $this->input('email'))->value('status') == config('const.USER_STATUS.PRE_REGISTER'),
            ];

            if($data['notFilled']) { return; } // 未入力エラーのみ出すため

            if($data['preRegister']) {
                $validator->errors()->add('status', 'まだ本登録が完了していません。');
                return;
            }
        });
    }

    /**
     * 属性定義
     *
     * @return array
     */
    public function attributes()
    {
        return[
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
