<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product is not found'], 404);
        }

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|integer'
        ]));

        return response()->json($product, 201);
    }

    // Обновление товара
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|integer'
        ]));

        return response()->json($product);
    }

    // Удаление товара
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
