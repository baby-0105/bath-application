<?php

namespace App\Http\Requests\Bath;

use Illuminate\Foundation\Http\FormRequest;

/**
 * お風呂検索 リクエストクラス
 */
class SearchRequest extends FormRequest
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
     * （一方の評価がカラの場合、最大値or最小値をセット）
     *
     */
    protected function prepareForValidation()
    {
        if(isset($this->high_eval) && empty($this->row_eval))                     { $this->merge(['row_eval' => config('const.EVAL.ROW_EVAL')]); }
        if(isset($this->high_hot_water) && empty($this->row_hot_water_eval))      { $this->merge(['row_hot_water_eval' => config('const.EVAL.ROW_EVAL')]); }
        if(isset($this->high_rock_eval) && empty($this->row_rock_eval))           { $this->merge(['row_rock_eval' => config('const.EVAL.ROW_EVAL')]); }
        if(isset($this->high_sauna_eval) && empty($this->row_sauna_eval))         { $this->merge(['row_sauna_eval' => config('const.EVAL.ROW_EVAL')]); }
        if(isset($this->row_eval) && empty($this->high_eval))                     { $this->merge(['high_eval' => config('const.EVAL.HIGH_EVAL')]); }
        if(isset($this->row_hot_water_eval) && empty($this->high_hot_water_eval)) { $this->merge(['high_hot_water_eval' => config('const.EVAL.HIGH_EVAL')]); }
        if(isset($this->row_rock_eval) && empty($this->high_rock_eval))           { $this->merge(['high_rock_eval' => config('const.EVAL.HIGH_EVAL')]); }
        if(isset($this->row_sauna_eval) && empty($this->high_sauna_eval))         { $this->merge(['high_sauna_eval' => config('const.EVAL.HIGH_EVAL')]); }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prefecture' => ['bail', 'nullable', 'exists:code_names,code,group_key,PREFECTURE'],
            'keyword' => ['bail', 'nullable', 'string', 'max:30', 'regex:/^[^#<>^;_]*$/'],
            'row_eval' => ['bail', 'nullable', 'lte:high_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'row_hot_water_eval' => ['bail', 'nullable', 'lte:high_hot_water_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'row_rock_eval' => ['bail', 'nullable', 'lte:high_rock_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'row_sauna_eval' => ['bail', 'nullable', 'lte:high_sauna_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'high_eval' => ['bail', 'nullable', 'gte:row_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'high_hot_water_eval' => ['bail', 'nullable', 'gte:row_hot_water_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'high_rock_eval' => ['bail', 'nullable', 'gte:row_rock_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'high_sauna_eval' => ['bail', 'nullable', 'gte:row_sauna_eval', 'exists:code_names,code,group_key,EVAL_SEARCH'],
            'field' => [
                'bail', 'required_without_all:prefecture,keyword,row_eval,row_hot_water_eval,row_rock_eval,row_sauna_eval,
                high_eval,high_hot_water_eval,high_rock_eval,high_sauna_eval'
            ]
        ];
    }

    /**
     * 属性定義
     *
     */
    public function attributes()
    {
        return [
            'keyword' => 'キーワード',
            'row_eval' => '全体評価(低)',
            'row_hot_water_eval' => 'お湯評価(低)',
            'row_rock_eval' => '岩盤浴評価(低)',
            'row_sauna_eval' => 'サウナ評価(低)',
            'high_eval' => '全体評価(高)',
            'high_hot_water_eval' => 'お湯評価(高)',
            'high_rock_eval' => '岩盤浴評価(高)',
            'high_sauna_eval' => 'サウナ評価(高)',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return void
     */
    public function messages()
    {
        return [
            'field.required_without_all' => '入力欄は1つ以上入力してください'
        ];
    }
}
