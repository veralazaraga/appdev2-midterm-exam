<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::get();
    }

    public function store(Request $request)
    {
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        
        return [
            'message' => 'Added Successfully'
        ];
    }

    public function show($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return [
                'message' => 'Product Not Found'
            ];
        }
        return $product;
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return [
                'message' => 'Product Not Found'
            ];
        }
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        return [
            'message' => 'Updated Successfully'
        ];
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return [
                'message' => 'Product Not Found'
            ];
        }

        $product->delete();

        return 'delete';
    }
}

