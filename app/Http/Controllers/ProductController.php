<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStockRequest;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\StockLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'status' => 'string|max:64',
            'stock' => 'required|integer|min:0'
        ]);

        DB::beginTransaction();
        try {
            $product = new Product();

            $product->fill($validatedData);

            if ($request->hasFile('photo')) {
                $product->photo = $request->file('photo')->store('uploads', 'public');
            }

            $product->save();

            $this->writeLog($product->id, $product->stock, 'masuk', 'Produk baru ditambahkan');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan produk "' . $request->name . '", ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan produk "' . $product->name . '"');
    }

    private function writeLog($productId, $stockChange, $type, $information)
    {
        $logData = [
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'stock_change' => $stockChange,
            'type' => $type,
            'information' => $information,
        ];

        DB::beginTransaction();
        try {
            $stockLog = new StockLog();

            $stockLog->fill($logData);
            $stockLog->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
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
