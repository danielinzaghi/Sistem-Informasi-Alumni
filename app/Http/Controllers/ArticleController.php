<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Article::with('kategori', 'user')->latest()->get();
        return view('artikel.article.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artikel.article.create',[
            'categories' => Category::get()
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        // Validasi data dari `ArticleRequest`
        $data = $request->validated();

        // Tambahkan user_id dari user yang login
        $data['users_id'] = auth()->id(); // Sesuai dengan model

        // Buat slug otomatis dari judul
        $data['slug'] = Str::slug($request->judul);

        // Jika ada gambar yang diunggah
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/articles', $fileName, 'public');
            $data['img'] = $fileName;
            
        }

        
    
        // Simpan data artikel ke database
        $article = Article::create($data);
        

        return redirect()->route('admin.ArticleIndex')->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $article = Article::with(['kategori', 'user'])->findOrFail($id);
    return view('artikel.article.show', compact('article'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
    
        // Hapus gambar dari storage jika ada
        if ($article->img) {
            Storage::delete('public/articles/' . $article->img);
        }
    
        $article->delete();
    
        return redirect()->route('admin.ArticleIndex')->with('success', 'Artikel berhasil dihapus.');
    }
    
}
