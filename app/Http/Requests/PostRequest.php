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
    public function rules()
    {
        $post = $this->route()->parameter("post");

        $rules = [
            'name' => 'required|min:3',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
        ];
        
        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        if ($this->status == 2) {
            $rules = array_merge($rules,[
                'image' => 'required|image|max:2048',
                'category_id' => 'required|exists:categories,id',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }
        return $rules;
    }
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
                'image' => 'required|image|max:2048',
                'category_id' => 'required|exists:categories,id',
                'tags' => 'required|array',
                'selectedTags' => 'required|array',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }
       
        return $rules;
    }
}
