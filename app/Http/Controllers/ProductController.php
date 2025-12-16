<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * READ: Menampilkan semua produk
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('product.index', compact('products', 'categories'));
    }

    /**
     * CREATE: Form tambah produk (untuk view)
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * STORE: Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->only(['name', 'description', 'price', 'category_id']));

        return redirect()->route('products.index')
        ->with('success', 'Produk berhasil diperbarui');

    }

    /**
     * READ: Menampilkan detail produk
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json(['data' => $product]);
    }

    /**
     * UPDATE: Form edit produk (untuk view)
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * UPDATE: Update produk
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'category_id']));

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * DELETE: Hapus produk
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }
}