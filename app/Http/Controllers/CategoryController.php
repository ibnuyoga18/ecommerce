<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * READ: Menampilkan semua kategori
     */
    
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * CREATE: Form tambah kategori (untuk view)
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * STORE: Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:255']);

        $category = Category::create(['name' => $request->name]);

        return redirect()->route('categories.index')
        ->with('success', 'Category updated successfully');

    }

    /**
     * READ: Menampilkan detail kategori
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['data' => $category]);
    }

    /**
     * UPDATE: Form edit kategori (untuk view)
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * UPDATE: Update kategori
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|max:255']);

        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('categories.index')
        ->with('success', 'Category updated successfully');

    }

    /**
     * DELETE: Hapus kategori
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
        ->with('success', 'Category updated successfully');

    }
}