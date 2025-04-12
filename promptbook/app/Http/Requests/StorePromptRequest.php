<?php

/*
    Contributor: Stephan
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePromptRequest extends FormRequest
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
            'title' => 'required|string|max:55|unique:prompts,title',
            'description' => 'nullable|string|max:500',
            'is_public' => 'nullable|boolean',
            'output_format' => 'nullable|string|in:json,html,markdown',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.unique' => 'The title has already been taken.',
            'title.max' => 'The title may not be longer than 55 characters.',
            'output_format.in' => 'The output format must be one of the following: json, html, markdown.',
            'description.max' => 'The description may not be longer than 500 characters.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // this is needed because checkbox gives null and "on" instead of boolean or integer
        $this->merge([
            'is_public' => $this->input('is_public') !== null ? 1 : 0,
        ]);
    }
}
