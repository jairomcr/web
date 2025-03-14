<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'address' => 'required|string',
            'phrase' => 'required|string',
            'logo' => [
                'nullable',
                'image',
                'max:5',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        list($width, $height) = getimagesize($value->getRealPath());
                        if ($width !== 166 || $height !== 50) {
                            $fail('La imagen debe tener dimensiones de 165x50 píxeles.');
                        }
                    }
                },
            ], 
            'extract' => 'required|string',
            'phone' => 'required|digits_between:1,20',
            'email' => 'required|email|max:255',
            'video_img' => [
                'nullable',
                'image',
                'max:65',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        list($width, $height) = getimagesize($value->getRealPath());
                        if ($width !== 768 || $height !== 768) {
                            $fail('La imagen debe tener dimensiones de 768x768 píxeles.');
                        }
                    }
                },
            ],
            'image' => [
                'nullable',
                'image',
                'max:140', // Tamaño máximo en kilobytes
                function ($attribute, $value, $fail) {
                    if ($value) {
                        list($width, $height) = getimagesize($value->getRealPath());
                        if ($width !== 1920 || $height !== 808) {
                            $fail('La imagen debe tener dimensiones de 1920x808 píxeles.');
                        }
                    }
                },
            ],
            'description' => 'required|string',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:512000|not_in:forbidden_video.mp4',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'title.required' => 'El campo título es obligatorio.',
            'subtitle.required' => 'El campo subtítulo es obligatorio.',
            'address.required' => 'La dirección es necesaria.',
            'phrase.required' => 'La frase es obligatoria.',
            'logo.image' => 'El logo debe ser una imagen válida.',
            'logo.max' => 'El logo no puede exceder 5 kB.',
            'extract.required' => 'El extracto es obligatorio.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits_between' => 'El teléfono debe tener entre 1 y 20 dígitos.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingresa un correo electrónico válido.',
            'video_img.image' => 'La imagen del video debe ser una imagen válida.',
            'video_img.max' => 'La imagen no puede exceder 65 KB.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no puede exceder 135 KB.',
            'description.required' => 'La descripción es obligatoria.',
            'video.mimetypes' => 'El video debe ser un archivo de tipo mp4, avi, mpeg o quicktime.',
            'video.max' => 'El video no puede exceder 500 MB.',
            'video.not_in' => 'Este video está prohibido.',
        ];
    }
}
