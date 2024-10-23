<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStockRequest;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\StockLog;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        Product::create($validatedData);

        return redirect()->back()->with('success', 'Berhasil menambahkan produk baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Add the stock of the product.
     */
    public function addStock(AddStockRequest $request, Product $product)
    {
        $validatedData = $request->validate([
            'stock' => 'required|integer|min:1',
            'information' => 'required|string|max:255',
        ]);

        // Update stock
        $product->stock += $validatedData['stock'];
        $product->save();

        // Writting log
        StockLog::create([
            'product_id' => $product->id,
            'added_stock' => '+' . $validatedData['stock'],
            'information' => $validatedData['information'],
            // 'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Stok produk "' . $product->name . '" berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
