<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    // all product page
    public function allProducts()
    {

        $products = Product::paginate(12);
        return view('shop.all-products', [
            'products' => $products,
            'nav' => 'Semua produk'
        ]);
    }

    // display all categories
    public function allCategories()
    {
        return view('shop.all-categories', ['nav' => 'Kategori']);
    }

    public function showCategory()
    {
        return view('shop.show-categories', ['nav' => 'Kategori ...']);
    }

    // bag page
    public function bag(Request $request)
    {
        // if there is no request return invalid bag
        if (!isset($request->bag)) {
            return redirect()->back()->with('error', 'Kesalahan akses tas belanja');
        }

        // parse the request
        $items = json_decode($request->bag, true);

        // Convert items to product models
        $products = [];
        foreach ($items as $item) {
            $product = Product::find($item['id']);
            $product->quantity = $item['quantity'];
            $products[] = $product;
        }

        // calculates price
        $total_price = 0;
        foreach ($products as $p) {
            $p->price = $p->price * $p->quantity;
            $total_price += $p->price;
        }

        return view('shop.bag', [
            'nav' => 'Tas belanja',
            'items' => $items,
            'total' => $total_price
        ]);
    }
}
