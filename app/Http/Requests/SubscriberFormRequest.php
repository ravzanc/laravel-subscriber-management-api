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
        $rules = [
            'email' => ['required', 'email', new ActiveEmailHostDomain()],
            'name' => 'required|string|min:3|max:255',
            'state' => ['required', Rule::enum(SubscriberState::class)],
        ];

        if ('application/vnd.api+json' === $this->header('Content-Type')) {
            return array_combine(
                ['data.attributes.email','data.attributes.name', 'data.attributes.state'],
                $rules
            );
        }

        return $rules;
    }
}
