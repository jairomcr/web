<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function generateSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug); // Replace non-alphanumeric characters
        $slug = preg_replace('/(^-|-$)/', '', $slug); // Remove beginning and end dashes
        return $slug;
    }
    public function createCategory($name, $slug)
    {
        Category::create([
            "name" => $name,
            "slug" => $slug,
        ]);
    }
    public function getPaginationCategories($search = '', $sort='id', $direction='asc',$perPage = 6)
    {
        return Category::where('name', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%')->orderBy($sort, $direction)->paginate($perPage);
    }
    public function updateCategory(Category $category,$name,$slug)
    {
        $category->name = $name;
        $category->slug = $slug;
        $category->save();
    }
    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId)->first();
        if ($category) {
            $category->delete();
        }
    }
}
