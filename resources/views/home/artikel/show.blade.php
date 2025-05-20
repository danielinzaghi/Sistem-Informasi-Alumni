@extends('layouts.main')

@push('css')
   <link rel="stylesheet" href="{{ asset('berita/css/custom.css') }}">
   <style>
    .custom-link {
    color: blue; /* Warna biru untuk link */
    text-decoration: none; /* Menghilangkan underline default */
}

.custom-link:hover {
    text-decoration: underline; /* Tambahkan underline saat di-hover */
}

   </style>
@endpush

@section('title', $article->title)

@section('content')

<!-- Breadcrumbs -->
<div class="breadcumbs py-2">
    <div class="container">
        <div class="d-flex justify-content-between text-white">
            <h2>Artikel</h2>
            <ol class="d-flex list-unstyled">
                <li>Home</li>
                <li>Artikel</li>
            </ol>
        </div>
    </div>
</div>



<!-- Page Content -->
<div class="container py-4">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8" data-aos="fade-up">
            <div class="card mb-4">
                <a href="{{ url('p/'.$article->slug) }}">
                    <img class="card-img-top single-img img-fluid" src="{{ asset('storage/uploads/articles/'.$article->img) }}" alt="{{ $article->title }}">
                </a>
                <div class="card-body">
                    <div class="small text-muted">
                            <div class="small text-muted">{{ $article->created_at->format('d-m-Y') }} | {{ $article->User->name }} </div>
                        <span>
                            {{-- <a href="{{ url('category/'.$article->Category->slug) }}" class="custom-link">
                                {{ $article->Category->name }}
                            </a> --}}
                        </span>
                        
                        <span>
                           | Views : {{ $article->views }} <!-- Menampilkan jumlah views -->
                        </span>
                    </div> 
                    <h1 class="card-title">{{ $article->title }}</h1>
                    <p class="card-text">{!! $article->deskripsi !!}</p>
                </div>
            </div>
        </div>
        
        <!-- Side widgets-->
                @include('layouts.side-widgets')
        
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('berita/js/script.js') }}"></script>

@endsection
