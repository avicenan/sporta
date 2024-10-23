<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Http\Requests\StoreBagRequest;
use App\Http\Requests\UpdateBagRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function bag()
    {
        // all products in bag
        $products = Bag::find(Auth::id())->products;

        return view('checkout.bag', [
            'nav' => 'Tas Belanja',
            'products' => $products
        ]);
    }

    public function addToBag(Request $request)
    {
        // check if user authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu untuk checkout');
        }

        $user = Auth::user();
        $bag = Bag::find($user->id);

        // check user bag
        if (!$bag) {
            Bag::create([
                'id' => $user->id,
                'status' => 'aktif',
            ]);
        }

        // check if product doesn't exist in bag, add product to bag
        if (!$bag->products->contains($request->id)) {
            $bag->products()->attach($request->id, [
                'quantity' => $request->quantity,
            ]);
        } else {
            $currentQuantity = $bag->products()->find($request->id)->pivot->quantity;
            $bag->products()->updateExistingPivot($request->id, [
                'quantity' => $currentQuantity + 1,
            ]);
        }

        return redirect('/shop')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function dropFromBag(Request $request)
    {
        // check if user authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu untuk checkout');
        }

        $user = Auth::user();
        $bag = Bag::find($user->id);

        // check if product exists in bag, delete product from bag
        if ($bag->products->contains($request->id)) {
            $currentQuantity = $bag->products()->find($request->id)->pivot->quantity;
            if ($currentQuantity > 1) {
                $bag->products()->updateExistingPivot($request->id, [
                    'quantity' => $currentQuantity - 1,
                ]);
            } else {
                $bag->products()->detach($request->id);
            }
        }

        return redirect('/shop')->with('success', 'Produk dihapus dari keranjang');
    }
}
