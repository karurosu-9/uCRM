<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'memo' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'is_selling' => ['required', 'boolean']
        ];
    }

    public function attributes()
    {
        return [
            'name' => '商品名',
            'memo' => 'メモ',
            'price' => '商品価格',
            'is_selling' => 'ステータス'
        ];
    }

    public function messages()
    {
        return [
            // 商品名
            'name.required' => ':attributeが入力されていません。',
            'name.string' => ':attributeに数字や記号は使用できません。',
            'name.max' => ':attributeは255文字以内で入力してください。',

            // メモ
            'memo.string' => ':attributeに数字や記号は使用できません。',
            'memo'.'string' => ':attributeは255文字以内で入力してください。',

            // 商品価格
            'price.required' => ':attributeが入力されていません。',
            'price.integer' => ':attributeは数字で入力してください。',

            // ステータス
            'is_selling.required' => ':attributeが入力されていません。',
            'is_selling.boolean' => ':attributeは真偽値で設定してください。'
        ];
    }
}
