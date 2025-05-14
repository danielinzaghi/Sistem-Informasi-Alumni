@extends('layouts.main')

@push('css')
   <link rel="stylesheet" href="{{ 'berita/css/custom.css' }}" rel="stylesheet" >
   <style>
    .img-resized {
        width: 100%; /* Sesuaikan lebar gambar dengan kontainer */
        max-height: 400px; /* Atur tinggi maksimum agar gambar lebih kecil */
        object-fit: cover; /* Pastikan gambar tidak terpotong */
        background-color: rgb(248, 245, 248); /* Opsional: tambahkan latar belakang jika gambar memiliki ruang kosong */
    }
   </style>
@endpush

@section('title')
    Artikel
@endsection

@section('content')
<!-- breadcumbs -->


<!-- Page header with logo and tagline-->
<div class="about-us mt-5">
    <div class="container">
        <div class="title-container">
            <h2 class="text-center fw-bold">ARTIKEL</h2>
        </div>

        <!-- Page content-->
        <div class="container">
            <div class="row mt-5">
                <!-- Blog entries-->
                <div class="col-lg-8">

                    <!-- Artikel-->
                    @if ($latest_post)
                    <div class="card mb-4 shadow-sm" data-aos="fade-in">
                        <a href="{{ url('p/'.$latest_post->slug) }}">
                            <img class="card-img-top featured-img img-resized" src="{{ asset('storage/uploads/articles/'.$latest_post->img) }}" alt="Gambar unggulan" />
                        </a>
                        <div class="card-body">
                            <div class="small text-muted">
                                {{ $latest_post->created_at->format('d-m-Y') }} | 
                                {{ $latest_post->User->name ?? 'Tidak diketahui' }} | 
                                {{ $latest_post->Category->nama ?? 'Tanpa Kategori' }}
                            </div>
                            <h2 class="card-title">{{ $latest_post->title }}</h2>
                            <p class="card-text">{!! Str::words($latest_post->deskripsi, 15, '.....') !!}</p>
                            <a class="btn btn-primary" href="{{ url('p/'.$latest_post->slug) }}">Read more →</a>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning text-center">
                        Tidak ada artikel terbaru yang ditemukan.
                    </div>
                    @endif

                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        @if ($articles->isNotEmpty())
                            @foreach ($articles as $item)  
                            <div class="col-lg-6" data-aos="fade-up">
                                <!-- Blog post-->
                                <div class="card mb-4 shadow-sm">
                                    <a href="{{ url('p/'.$item->slug) }}">
                                        <img class="card-img-top post-img" src="{{ asset('storage/uploads/articles/'.$item->img) }}" alt="Deskripsi gambar" />
                                    </a>
                                    <div class="card-body card-height">
                                        <div class="small text-muted">
                                            <div class="small text-muted">
                                                {{ $item->created_at->format('d-m-Y') }} | 
                                                {{ $item->User->name ?? 'Tidak diketahui' }} | 
                                                {{ optional($item->Category)->nama ?? 'Tanpa Kategori' }}
                                            </div>
                                        </div>             
                                        <h2 class="card-title h4">{{ $item->title }}</h2>
                                        <p class="card-text">{!! Str::words($item->deskripsi, 15, '.....') !!}</p>
                                        <a class="btn btn-primary" href="{{ url('p/'.$item->slug) }}">Read more →</a>
                                    </div>
                                </div>
                                <!-- Blog post-->
                            </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center">
                                <p class="text-muted">Tidak ada artikel yang tersedia saat ini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination-->
                    <nav aria-label="Page navigation">
                        <hr class="my-4" />
                        <div class="d-flex justify-content-center">
                            {{ $articles->links() }}
                        </div>
                    </nav>
                </div>
                <!-- Side widgets-->
                @include('layouts.side-widgets')
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('berita/js/script.js') }}"></script>

@endsection
