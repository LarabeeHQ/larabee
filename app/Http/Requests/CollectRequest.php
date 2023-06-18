<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectRequest extends FormRequest
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
            'browser' => ['required', 'array'],
            'device' => ['required', 'string'],
            'hostname' => ['required', 'string'],
            'language' => ['nullable', 'string'],
            'os' => ['required', 'string'],
            'referrer' => ['nullable', 'url'],
            'screen' => ['required', 'string'],
            'url' => ['required', 'array'],
            'website_id' => ['required', 'uuid'],
        ];
    }
}
