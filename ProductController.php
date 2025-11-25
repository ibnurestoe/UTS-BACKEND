<?php

namespace App\Http\Controllers; // Pastikan namespace ini ada di paling atas

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        return view('products.index', compact('products'));
    }

    // --- BAGIAN YANG DIPERBAIKI ---
    public function create()
    {
        return view('products.create');
    }
    // ------------------------------

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:100',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Product::create([
            'name'  => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:100',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'Gagal mengupdate data, periksa inputan Anda.');
            
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $product = Product::findOrFail($id);
        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}