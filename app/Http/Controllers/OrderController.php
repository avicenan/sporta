<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Bag;
use App\Models\StockLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.order.index', [
            'nav' => 'Penjualan',
            'orders' => Order::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    public function store(Request $request)
    {

        // validate request checkout
        $request->validate([
            'payment_method' => 'required',
            'member_id' => 'numeric|nullable',
            'cashier_id' => 'required|numeric',
        ]);

        $user = User::find($request->cashier_id);
        $bag = Bag::find($user->bag_id);

        // check product stock
        foreach ($bag->products as $product) {
            if ($product->pivot->quantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok ' . $product->name . ' tidak mencukupi',
                ], 400);
            }
        }

        // count total price
        $totalPrice = 2500;
        foreach ($bag->products as $product) {
            $totalPrice += $product->pivot->sum_price;
        }

        // create order
        $orderData = [
            'code' => date('YmdHis') . $user->bag_id,
            'user_id' => $user->id,
            'bag_id' => $user->bag_id,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'member_id' => $request->member_id,
        ];

        $order = Order::create($orderData);

        // update product stock
        foreach ($bag->products as $product) {
            $product->stock -= $product->pivot->quantity;
            $product->save();
        }

        // writting stock log
        foreach ($bag->products as $product) {
            StockLog::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'stock_change' => $product->pivot->quantity,
                'type' => 'keluar',
                'information' => 'Produk dibeli dalam order #' . $order->code,
            ]);
        }

        // create order items data
        foreach ($bag->products as $product) {
            $order->items()->create([
                'product_code' => $product->code,
                'product_name' => $product->name,
                'quantity' => $product->pivot->quantity,
                'sum_price' => $product->pivot->sum_price,
            ]);
        }

        // clear bag
        $user->bag->products()->detach();

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}