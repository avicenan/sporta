<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BagController extends Controller
{

    public function bag()
    {
        $user = Auth::user();

        // all products in bag
        $products = Bag::find($user->bag_id)->products;

        // total price
        $totalPrice = 2500;
        foreach ($products as $product) {
            $totalPrice += $product->pivot->sum_price;
        }

        return view('checkout.bag', [
            'nav' => 'Tas Belanja',
            'products' => $products,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function addToBag(Request $request)
    {

        // check if user authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu untuk checkout');
        }

        $user = Auth::user();
        // $product = Product::find($request->id);
        $bag = Bag::find($user->bag_id);

        // add product to bag
        if (!$bag->products->contains($request->product_id)) {
            $bag->products()->attach($request->product_id, [
                'quantity' => 1,
                'sum_price' => Product::find($request->product_id)->price,
            ]);
        } else {
            $currentQuantity = $bag->products()->find($request->product_id)->pivot->quantity;
            $bag->products()->updateExistingPivot($request->product_id, [
                'quantity' => $currentQuantity + 1,
                'sum_price' => $bag->products()->find($request->product_id)->price * ($currentQuantity + 1),
            ]);
        }

        // get total price of a bag
        $bag = Bag::find($user->bag_id);
        $totalPrice = 2500;
        foreach ($bag->products as $product) {
            $totalPrice += $product->pivot->sum_price;
        }

        return response()->json([
            'success' => true,
            'message' => "Menambahkan '" . Product::find($request->product_id)->name . "' ke tas belanja!",
            'quantity' => $bag->products()->find($request->product_id)->pivot->quantity,
            'sum_price' => $bag->products()->find($request->product_id)->pivot->sum_price,
            'total_price' => $totalPrice
        ]);
    }

    public function dropFromBag(Request $request)
    {
        // check if user authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu untuk checkout');
        }

        $user = Auth::user();
        // $product = Product::find($request->id);
        $bag = Bag::find($user->id);

        // check if product exists in bag, delete product from bag
        if ($bag->products->contains($request->product_id)) {
            $currentQuantity = $bag->products()->find($request->product_id)->pivot->quantity;
            if ($currentQuantity > 1) {
                $bag->products()->updateExistingPivot($request->product_id, [
                    'quantity' => $currentQuantity - 1,
                    'sum_price' => $bag->products()->find($request->product_id)->price * ($currentQuantity - 1),
                ]);
            } else {
                $bag->products()->detach($request->product_id);
            }
        }

        // get total price of a bag
        $bag = Bag::find($user->id);
        $totalPrice = 2500;
        foreach ($bag->products as $product) {
            $totalPrice += $product->pivot->sum_price;
        }

        return response()->json([
            'success' => true,
            'message' => "Mengurangi '" . Product::find($request->product_id)->name . "' dari tas belanja!",
            'quantity' => $bag->products()->find($request->product_id)->pivot->quantity ?? 0,
            'sum_price' => $bag->products()->find($request->product_id)->pivot->sum_price ?? 0,
            'total_price' => $totalPrice
        ]);
    }
}
