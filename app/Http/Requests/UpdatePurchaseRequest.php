<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'customer_id' => '会員',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => ':attributeが選択されていません。',
        ];
    }
}
