<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        return view('dashboard.category.index', [
            'nav' => 'Kategori',
            'categories' => $categories
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {

        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|unique:categories|max:255',
                'icon' => 'required|string|max:64',
                'description' => 'required|string|max:1000',
                'status' => 'string|max:64',
            ]);

            $category = new Category();
            $category->fill($validatedData);
            $category->save();

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambahkan kategori baru');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menambahkan kategori, ' . $e->getMessage());
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // return dd($request);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:64',
            'description' => 'required|string|max:1000',
            'status' => 'string|max:64',
        ]);

        // return dd($validatedData);

        DB::beginTransaction();

        try {
            $category->fill($validatedData);
            $category->save();

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil merperbarui kategori "' . $request->name . '"');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memperbarui kategori, ' . $e->getMessage());
        }
    }
}
