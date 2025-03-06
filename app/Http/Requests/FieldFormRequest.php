<?php

namespace App\Http\Requests;

use App\Enums\FieldType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FieldFormRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'type' => ['required', Rule::enum(FieldType::class)],
        ];

        if ('application/vnd.api+json' === $this->header('Content-Type')) {
            return array_combine(
                ['data.attributes.title','data.attributes.type'],
                $rules
            );
        }

        return $rules;
    }
}
