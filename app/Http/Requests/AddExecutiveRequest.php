<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddExecutiveRequest extends FormRequest
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
            'newExecutive.name' => 'required|string|max:255',
            'newExecutive.position' => 'required|string|max:255',
            'newExecutive.photo' => 'nullable|image|max:1024',
        ];
    }
}
