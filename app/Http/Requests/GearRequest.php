<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GearRequest extends FormRequest
{
    public function rules()
    {
        return [
            'gear.title' => 'required|string|max:100',
            'gear.body' => 'required|string|max:4000',
        ];
    }
}
