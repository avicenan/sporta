<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStockRequest;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\StockLog;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        $categories = Category::select('id', 'name')->get();

        return view('dashboard.product.index', [
            'nav' => 'Produk',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'status' => 'string|max:64',
        ]);

        // Handle the file upload 
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('uploads', 'public');
            $validatedData['photo'] = $filePath;
        }

        // Save the validated data to the database
        try {
            $product = Product::create($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk "' . $request->name . '", ' . $e->getMessage());
        }

        // writting log
        StockLog::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'stock_change' => $product->stock,
            'type' => 'masuk',
            'information' => 'Produk baru ditambahkan',
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan produk "' . $product->name . '"');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'status' => 'string|max:64',
        ]);

        // Handle the file upload 
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('uploads', 'public');
            $validatedData['photo'] = $filePath;
        }

        // Save the validated data to the database
        $product->update($validatedData);

        return redirect()->back()->with('success', 'Berhasil mengubah produk "' . $product->name . '"');
    }

    public function addStock(AddStockRequest $request, Product $product)
    {
        $validatedData = $request->validate([
            'qty' => 'required|integer|min:1',
            'information' => 'required|string|max:255',
        ]);

        // Update stock
        $product->stock += $validatedData['qty'];
        $product->save();

        StockLog::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'stock_change' => $validatedData['qty'],
            'type' => 'masuk',
            'information' => $validatedData['information'],
        ]);

        return redirect()->back()->with('success', 'Stok produk "' . $product->name . '" berhasil ditambahkan!');
    }

    public function deactivate(Product $product)
    {
        //
    }
}
