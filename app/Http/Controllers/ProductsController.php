<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Products::all();
            return response()->json($products);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch products.",
                $error
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'quantity' => 'required|string',
            'image' => 'required|string',
            'brand' => 'required|string',
            'rating' => 'required|string',
        ]);

        try {
            $product = new Products();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->quantity = $request->quantity;
            $product->image = $request->image;
            $product->brand = $request->brand;
            $product->rating = $request->rating;
            $product->save();
            return response()->json($product);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to create a product.",
                $error
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products, $id)
    {
        try {
            $product = Products::findOrFail($id);
            return response()->json($product);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch product.",
                $error
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'quantity' => 'required|string',
            'image' => 'required|string',
            'brand' => 'required|string',
            'rating' => 'required|string',
        ]);

        try {
            $product = Products::findOrFail($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->quantity = $request->quantity;
            $product->image = $request->image;
            $product->brand = $request->brand;
            $product->rating = $request->rating;
            $product->update();
            return response()->json($product);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to update product.",
                $error
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products, $id)
    {
        try {
            $product = Products::findOrFail($id);
            $product->delete();
            return response()->json("Product deleted successfully");
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to delete product.",
                $error
            ], 500);
        }
    }
}
