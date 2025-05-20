<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Str;  
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Article::with('kategori', 'user')->latest()->get();
        $user = Auth::user();
        // dd($user->roles->first());
        if($user->roles->first()->name == 'alumni') {
            $beritas = Article::with('kategori', 'user')->where('user_id', $user->id)->latest()->get();
        }
        return view('artikel.article.index', compact('beritas', 'user'));
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
        $data['user_id'] = Auth::user()->id; // Sesuai dengan model

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

        toast('Artikel berhasil dibuat!')->autoClose(2000);
        return redirect()->route(Auth::user()->roles->first()->name . '.article.index');
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
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('artikel.article.update', compact('article', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest  $request, $id)
    {
        $article = Article::findOrFail($id);
        
        // Menyiapkan data yang akan diupdate
        $data = $request->validated();
        
        // Jika ada gambar baru, hapus yang lama dan simpan yang baru
        if ($request->hasFile('img')) {
            Storage::delete($article->img);
            $data['img'] = $request->file('img')->store('uploads/articles');
        }
        
        $article->update($data);

        toast('Artikel berhasil diperbarui!', 'success')->autoClose(2000);
        return redirect()->route(Auth::user()->roles->first()->name . '.article.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
    
        try {
            // Hapus gambar dari storage jika ada
            if ($article->img) {
                Storage::disk('public')->delete('uploads/articles/' . $article->img);
            }
        
            $article->delete();
            toast('Artikel berhasil dihapus!', 'success');
            return redirect()->route(Auth::user()->roles->first()->name . '.article.index');
        } catch (\Exception $e) {
            Alert('Error',$e->getMessage(), 'error');
            return redirect()->route(Auth::user()->roles->first()->name . '.article.index');
        }
    }
    
}
