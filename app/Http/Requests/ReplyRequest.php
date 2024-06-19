<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reply.body' => 'required|string|max:1000',
        ];
    }
    
    public function messages()
    {
        return [
            'reply.body.required' => '返信を入力してください。',
            'reply.body.string' => '返信は文字列でなければなりません。',
            'reply.body.max' => '返信は000文字以内で入力してください。',
        ];
    }
}
