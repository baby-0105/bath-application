<?php

namespace App\Http\Requests\Bath;

use Illuminate\Foundation\Http\FormRequest;

/**
 * お風呂お気に入り登録 リクエストクラス
 */
class FavoriteRequest extends FormRequest
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
            'bathId' => [
                'bail',
                'required',
                'exists:baths,id',
                function ($attribute, $value, $fail) {
                    if(auth()->user()->favorite()->where('bath_id', $value)->exists()) {
                        $fail('すでに、お気に入り済みです。');
                    }
                },
            ]
        ];
    }
}
