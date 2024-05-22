<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment.body' => 'required|string|max:1000',
        ];
    }
    
    public function messages()
    {
        return [
            'comment.body.required' => 'コメントを入力してください。',
            'comment.body.string' => 'コメントは文字列でなければなりません。',
            'comment.body.max' => 'コメントは1000文字以内で入力してください。',
        ];
    }
}
