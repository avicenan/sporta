<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('dashboard.category.index', [
            'nav' => 'Kategori',
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
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories|max:255',
            'icon' => 'required|string|max:64',
            'description' => 'required|string|max:1000',
            'status' => 'string|max:64',
        ]);

        Category::create($validatedData);
        return redirect()->back()->with('success', 'Berhasil menambahkan kategori baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

        $category->update($validatedData);
        $category->save();

        return redirect()->back()->with('success', 'Berhasil merperbarui kategori "' . $request->name . '"');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
