<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;



class FrontArticleController extends Controller
{
    public function index(){
        $contact = Contact::first(); 
        return view('home.artikel.index',[
            'articles' => Article::whereStatus(1)->latest()->paginate(2),
            'contact' => $contact,
        ]);
    }
    
    public function show($slug)
    {
        // Ambil artikel berdasarkan slug
        $article = Article::whereSlug($slug)->firstOrFail();
        
        // Increment views
        $article->increment('views');
        
        // Ambil kategori dengan total artikel
        $categories = Category::withCount(['articles as total_articles' => function($query) {
            $query->where('status', 1);  // Hanya hitung artikel yang aktif
        }])->latest()->get();

        $popular_posts = Article::orderBy('views', 'desc')->take(3)->where('status', 1)->get();
    
        // Kirim ke view
        return view('home.artikel.show', [
            'article' => $article,
            'popular_posts' => $popular_posts,
            'categories' => $categories,  // Kirim kategori dengan total artikel
        ]);
    }
    
}
