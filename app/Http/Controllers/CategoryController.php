<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artikel.category.index',[
            'categories' => Category::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'nama' => 'required|min:3'
    ]);

    // Membuat slug dari nama kategori
    $data['slug'] = Str::slug($data['nama']);

    // Menyimpan ke dalam database
    Category::create([
        'nama' => $data['nama'],
        'slug' => $data['slug']
    ]);

    return back()->with('success', 'Kategori berhasil dibuat!');
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
    
     public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|min:3|unique:kategori,nama,' . $id
        ]);

        $data['slug'] = Str::slug($data['nama']);

        $category->update($data);

        return redirect()->route('admin.CategoryIndex')->with('success', 'Kategori berhasil diperbarui');
    }
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.CategoryIndex')->with('success', 'Kategori berhasil dihapus');
    }
}
