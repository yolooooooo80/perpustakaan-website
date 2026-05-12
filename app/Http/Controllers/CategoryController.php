<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fine_per_day' => 'required|integer|min:0',
            'loan_duration_days' => 'required|integer|min:1',
        ]);

        $category->update($request->all());

        return back()->with('success', 'Aturan kategori berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
            'fine_per_day' => 'required|integer|min:0',
            'loan_duration_days' => 'required|integer|min:1',
        ]);

        Category::create($request->all());

        return back()->with('success', 'Kategori baru ditambahkan.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori dihapus.');
    }
}
