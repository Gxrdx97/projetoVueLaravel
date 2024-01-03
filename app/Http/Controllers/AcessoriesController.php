<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccessoriesController extends Controller
{
    public function index()
    {
        $accessories = Accessory::all();
        return view('accessories.index', compact('accessories'));
    }

    public function create()
    {
        return view('accessories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ]);

        $accessory = Accessory::create($request->only(['name']));

        if ($request->has('products')) {
            $products = $request->input('products');
            $accessory->products()->attach($products);
        }

        return redirect()->route('accessories.index')->with('success', 'Acessório criado com sucesso!');
    }

    public function edit(Accessory $accessory)
    {
        return view('accessories.edit', compact('accessory'));
    }

    public function update(Request $request, Accessory $accessory)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('accessories')->ignore($accessory->id)],
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ]);

        $accessory->update($request->only(['name']));

        if ($request->has('products')) {
            $products = $request->input('products');
            $accessory->products()->sync($products);
        } else {
            $accessory->products()->detach();
        }

        return redirect()->route('accessories.index')->with('success', 'Acessório atualizado com sucesso!');
    }

    public function destroy(Accessory $accessory)
    {
        $accessory->delete();
        return redirect()->route('accessories.index')->with('success', 'Acessório deletado com sucesso!');
    }
}
