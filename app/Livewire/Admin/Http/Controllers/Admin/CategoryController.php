<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form data
        $validation = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'slug.required' => 'El campo slug es obligatorio.',
            'slug.unique' => 'El slug ya está en uso. Por favor, elige otro.'
        ]);
         
        //Creating a new category
        Category::create($validation);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría fue creada exitosamente');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|unique:categories,slug,$category->id",
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'slug.required' => 'El campo slug es obligatorio.',
            'slug.unique' => 'El slug ya está en uso. Por favor, elige otro.'
        ]);

        // Update category
        $category->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        // Redirect with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete category
        $category->delete();
        return redirect()->back()->with('success', 'Categoría sea eliminado exitosamente');
    }
}