<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    // all product page
    public function index(Request $request)
    {
        $categories = Category::select('id', 'name', 'icon')->where('status', 'aktif')->get();
        $bagCount = 0;
        $productsQuery = Product::query();

        // check if user authenticated and count how many product in bag_products
        if (Auth::check()) {
            $bagCount = Bag::find(Auth::id())->products()->count();
        }

        // query category
        if ($request->filled('category')) {
            $category = Category::where('name', $request->category)->first();
            if ($category) {
                $productsQuery = $category->products();
            }
        }

        // query search
        if ($request->filled('search')) {
            $productsQuery->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $productsQuery->paginate(12);

        return view('shop.index', [
            'nav' => $request->has('category') ? 'Produk kategori ' . $request->category : 'Semua produk',
            'products' => $products,
            'categories' => $categories,
            'bagCount' => $bagCount
        ]);
    }

    public function categories()
    {
        return view('shop.categories', [
            'nav' => 'Kategori olahraga',
        ]);
    }

    // bag page
    // public function bag(Request $request)
    // {
    //     // if there is no request return invalid bag
    //     if (!isset($request->bag)) {
    //         return redirect()->back()->with('error', 'Kesalahan akses tas belanja');
    //     }

    //     // parse the request
    //     $items = json_decode($request->bag, true);

    //     // Convert items to product models
    //     $products = [];
    //     foreach ($items as $item) {
    //         $product = Product::find($item['id']);
    //         $product->quantity = $item['quantity'];
    //         $products[] = $product;
    //     }

    //     // calculates price
    //     $total_price = 0;
    //     foreach ($products as $p) {
    //         $p->price = $p->price * $p->quantity;
    //         $total_price += $p->price;
    //     }

    //     return view('shop.bag', [
    //         'nav' => 'Tas belanja',
    //         'items' => $items,
    //         'total' => $total_price
    //     ]);
    // }
}
