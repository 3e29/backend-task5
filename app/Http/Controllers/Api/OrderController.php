<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json(OrderResource::collection($orders), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        if ($product->stock < 1) {
            return response()->json(['message' => 'Insufficient stock to place the order'], 400);
        }

        // Decrease the product stock by one
        $product->stock -= 1;
        $product->save(); // Save the updated stock

        $order = Order::create($request->all());

        return response()->json(new OrderResource($order), 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json(new OrderResource($order), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $order = Order::find($id);
    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    // Only allow cancellation if the order is still pending
    if ($order->status !== 'pending') {
        return response()->json(['message' => 'Only pending orders can be cancelled'], 400);
    }
    $product = $order->product;

    // Restore the product quantity
    $product->stock += 1;
    $product->save(); // Save the updated product stock

    $order->status = 'cancelled';
    $order->save();

    return response()->json(['message' => 'Order cancelled successfully'], 200);
}

}
