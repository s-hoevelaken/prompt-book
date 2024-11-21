<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPromptRequest extends FormRequest
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
            'content' => 'required|string|min:10|max:1000',
            'is_public' => 'nullable|integer|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be longer than 55 characters.',
            'content.required' => 'The content field cannot be empty.',
        ];
    }
}
