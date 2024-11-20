<?php

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
        return Auth::check();
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
            'is_public' => 'nullable|boolean'
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
