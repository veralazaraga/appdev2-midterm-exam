<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Product::get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        
        return response()->json([
            'message' => 'Added Successfully'
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                'message' => 'Product Not Found'
            ]);
        }

        return response()->json([
            'data' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                'message' => 'Product Not Found'
            ]);
        }
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        return response()->json([
            'message' => 'Updated Successfully'
        ]);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                'message' => 'Product Not Found'
            ]);
        }

        $product->delete();

        return response()->json([
            'message' => 'Deleted Successfully'
        ]);
    }
}

