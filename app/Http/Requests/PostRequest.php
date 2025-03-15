<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

    public static function getRules($status,$postId = null) {
        if($postId != null) {   
            $rules = [
                'name' => 'required|min:3',
                'slug' => 'required|unique:posts,slug,' . $postId,
                'status' => 'required|in:1,2',
            ];
        } else {
            $rules = [
                'name' => 'required|min:3',
                'slug' => 'required|unique:posts',
                'status' => 'required|in:1,2',
            ];
        }
        if ($status == 2) {
            $rules = array_merge($rules, [
                'category_id' => 'required|exists:categories,id',
                'selectedTags' => 'required|array|min:1',
                'selectedTags.*' => 'exists:tags,id',
                'extract' => 'required',
                'body' => 'required',
            ]);
            if (!$postId || request()->hasFile('image')) {
                $rules['image'] = ['required','image','max:200',function ($attribute, $value, $fail) {
                    if ($value) {
                        list($width, $height) = getimagesize($value->getRealPath());
                        if ($width !== 1024 || $height !== 768) {
                            $fail('La imagen debe tener dimensiones de 1024x768 píxeles.');
                        }
                    }
                  },
                ]; 
            }
        }
       
        return $rules;
    }
    
    /* public function attributes()
    {
        return [
            'name' => 'nombre',
            'slug' => 'slug',
            'status' => 'estado',
            'category_id' => 'categoría',
            'tags' => 'etiquetas',
            'extract' => 'extracto',
            'body' => 'cuerpo',
            'image' => 'imagen',
        ];
    } */
    public  function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.unique' => 'El slug ya está en uso.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser "Borrador" o "Publicado".',
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',
            'selectedTags.required' => 'Debes seleccionar al menos una etiqueta.',
            'selectedTags.array' => 'Las etiquetas deben ser un arreglo.',
            'selectedTags.min' => 'Debes seleccionar al menos una etiqueta.',
            'selectedTags.*.exists' => 'Una o más etiquetas seleccionadas no son válidas.',
            'extract.required' => 'El extracto es obligatorio.',
            'body.required' => 'El extracto es obligatorio.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no debe pesar más de :max kilobytes.',
        ];
    }

}
