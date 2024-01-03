<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'accessories' => 'nullable|array',
            'accessories.*' => 'exists:accessories,id',
        ]);

        $product = Product::create($request->only(['name', 'description', 'price']));

        if ($request->has('accessories')) {
            $accessories = $request->input('accessories');
            $product->accessories()->attach($accessories);
        }

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'accessories' => 'nullable|array',
            'accessories.*' => 'exists:accessories,id',
        ]);

        $product->update($request->only(['name', 'description', 'price']));

        if ($request->has('accessories')) {
            $accessories = $request->input('accessories');
            $product->accessories()->sync($accessories);
        } else {
            $product->accessories()->detach();
        }

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso');
    }

    public function destroy(Product $product)
    {
        $product->accessories()->detach();
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso');
    }
}
