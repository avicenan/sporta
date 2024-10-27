<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        // if user authenticated get bag products, else get empty bag
        $bagProducts = Auth::check() ? Bag::find(Auth::user()->bag_id)->products : [];

        // get categories
        $categories = Category::select('id', 'name', 'icon')->where('status', 'aktif')->get();

        // query products
        $productsQuery = Product::query()->where('stock', '>', 0)->orderBy('stock', 'desc');

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
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%');
            });
        }

        // paginate products
        $products = $productsQuery->paginate(12);

        // render view
        return view('shop.index', [
            'nav' => $request->has('category') ? 'Produk kategori ' . $request->category : 'Semua produk',
            'products' => $products,
            'categories' => $categories,
            'bagProducts' => $bagProducts
        ]);
    }

    public function categories()
    {
        return view('shop.categories', [
            'nav' => 'Kategori olahraga',
        ]);
    }
}
