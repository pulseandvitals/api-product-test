<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Http\Requests\ProductEditFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if(!empty($products))
        return response()->json([
            'products' => $products,
            'status' => 200,
        ]);
        return response()->json([
            'message' => 'No Products available',
        ]);
    }
    public function store(ProductFormRequest $request)
    {
        $product = Product::create([
            'price' => $request->price,
            'description' => $request->description,
            'name' => $request->name
        ]);
        if($product) {
            return response()->json([
                'message' => 'Successfully inserted a product.',
                'status' => 200,
            ]);
        }
    }
    public function show($id)
    {
        $product = Product::findOrfail($id);

        if($product) {
            return response()->json([
                'product' => $product,
                'status' => 200,
            ]);
        }
    }

    public function edit(ProductEditFormRequest $request,$id)
    {
        $product = Product::findOrfail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        if(!$product) {
            return response()->json([
                'error' => 'ID Not Found',
                'status' => 400,
            ]);
        }
        return response()->json([
                'message' => 'Successfully edited a product',
                'status' => 200,
            ]);
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json([
            'message' => 'Deleted a product',
            'status' => 200,
        ]);
    }
}
