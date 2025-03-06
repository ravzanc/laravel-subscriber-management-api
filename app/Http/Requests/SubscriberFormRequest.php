<?php

namespace App\Http\Requests;

use App\Enums\SubscriberState;
use App\Rules\ActiveEmailHostDomain;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriberFormRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.*.email' => ['required', 'email', 'unique:subscribers,email', new ActiveEmailHostDomain()],
            'data.*.name' => 'required|string|min:3|max:255',
            'data.*.state' => ['required', Rule::enum(SubscriberState::class)],
        ];
    }
}
