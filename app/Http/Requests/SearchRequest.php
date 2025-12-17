<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 検索リクエストのバリデーション
 * セキュリティ強化：入力値の検証
 */
class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:100'],
            'type' => ['nullable', 'string', 'in:all,quotes,proverbs,poems'],
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'q.max' => '検索キーワードは100文字以内で入力してください。',
            'type.in' => '無効な検索タイプです。',
            'page.min' => 'ページ番号は1以上を指定してください。',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('q')) {
            $this->merge([
                'q' => strip_tags($this->input('q')),
            ]);
        }
    }
}
