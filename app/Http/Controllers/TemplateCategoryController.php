<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplatesCategories;
class TemplateCategoryController extends Controller
{
    public function listCategories()
    {
        $categories = TemplatesCategories::all();
        return view('admin.templates.list-category', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.templates.create-category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:templates_categories,slug',
        ]);

        TemplatesCategories::create($request->only('name', 'slug'));

        return redirect()->route('create-category')->with('success', 'Category created successfully.');
    }

    public function editCategory(TemplatesCategories $category)
    {
        return view('admin.templates.edit-category', compact('category'));
    }

    public function updateCategory(Request $request, TemplatesCategories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:templates_categories,slug,' . $category->id,
        ]);

        $category->update($request->only('name', 'slug'));

        return redirect()->route('edit-category', $category->id)->with('success', 'Category updated successfully.');
    }

    public function deleteCategory(TemplatesCategories $category)
    {
        $category->delete();
        return redirect()->route('list-categories')->with('success', 'Category deleted successfully.');
    }


}
