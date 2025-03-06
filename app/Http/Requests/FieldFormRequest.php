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
        return [
            'data.*.title' => 'required|string|unique:fields,title|min:3|max:255',
            'data.*.type' => ['required', Rule::enum(FieldType::class)],
        ];
    }
}
