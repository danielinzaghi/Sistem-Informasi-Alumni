<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;


class LandingPageController extends Controller
{
    public function index()
    {
        $articles = Article::with('kategori')->whereStatus(1)->latest()->paginate(6);
        return view('LandingPage', compact('articles'));
    }

    public function berita()
{
    $keyword = request()->keyword;

    // Mengambil artikel terbaru
    $latest_post = Article::with(['user', 'kategori'])->latest()->first();

    // Menentukan artikel berdasarkan keyword atau tanpa keyword
    if ($keyword) {
        $articles = Article::with('kategori')
            ->where('status', 1)
            ->where('id', '!=', $latest_post?->id)
            ->where('judul', 'like', '%' . $keyword . '%')
            ->latest()
            ->paginate(6);
    } else {
        $articles = Article::with('kategori')
            ->where('status', 1)
            ->where('id', '!=', $latest_post?->id)
            ->latest()
            ->paginate(4);
    }

    // Mengambil kategori dengan total artikel yang aktif
    $categories = Category::with(['articles' => function ($query) {
        $query->where('status', 1);
    }])
    ->withCount(['articles as total_articles' => function ($query) {
        $query->where('status', 1);
    }])
    ->latest()
    ->get();

    // Mengambil artikel populer berdasarkan views terbanyak
    $popular_posts = Article::orderBy('views', 'desc')->take(3)->get();

    // Mengirim data ke view
    return view('home.artikel', [
        'latest_post' => $latest_post,
        'articles' => $articles,
        'categories' => $categories,
        'popular_posts' => $popular_posts,
    ]);
}


    

}
