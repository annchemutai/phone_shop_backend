<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orders = Orders::all();
            return response()->json($orders);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch orders.",
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
            'product_id' => 'required|string',
            'user_id' => 'required|string',
            'quantity' => 'required|string',
            'payment_status' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        try {
            $orders = new Orders();
            $orders->product_id = $request->product_id;
            $orders->user_id = $request->user_id;
            $orders->quantity = $request->quantity;
            $orders->payment_status = $request->payment_status;
            $orders->payment_method = $request->payment_method;
            $orders->save();
            return response()->json($orders);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to create a order.",
                $error
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders, $id)
    {
        try {
            $orders = Orders::findOrFail($id);
            return response()->json($orders);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch orders.",
                $error
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders, $id)
    {
        $request->validate([
            'product_id' => 'required|string',
            'user_id' => 'required|string',
            'quantity' => 'required|string',
            'payment_status' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        try {
            $orders = Orders::findOrFail($id);
            $orders->product_id = $request->product_id;
            $orders->user_id = $request->user_id;
            $orders->quantity = $request->quantity;
            $orders->payment_status = $request->payment_status;
            $orders->payment_method = $request->payment_method;
            $orders->update();
            return response()->json($orders);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to create a order.",
                $error
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders, $id)
    {
        try {
            $order = Orders::findOrFail($id);
            $order->delete();
            return response()->json("Order deleted successfully");
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to delete order.",
                $error
            ], 500);
        }
    }
}
