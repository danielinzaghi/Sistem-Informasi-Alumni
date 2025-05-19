<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;


class FrontCategoryController extends Controller
{
    public function index($slugCategory)
{
    // Menarik data kategori berdasarkan slug
    $category = Category::where('slug', $slugCategory)->first();
 
    return view('home.category.index', [
        'articles' => Article::with('kategori') // Mengambil artikel beserta kategorinya
            ->whereHas('kategori', function($q) use ($slugCategory) { // Filter berdasarkan slug kategori
                $q->where('slug', $slugCategory);
            })
            ->latest() // Urutkan artikel berdasarkan waktu
            ->paginate(3), // Pembagian halaman artikel
        'category' => $category, // Kirim data kategori ke view
    ]);
}

    
    
}
