@extends('layout.app')

@push('css')
   <link rel="stylesheet" href="{{ asset('berita/css/custom.css') }}">
@endpush

@section('title', 'Artikel')

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

<!-- Page Header -->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="container">
    <div class="mb-3">
        <form action="{{ route('search') }}" class="d-flex justify-content-between" method='GET'>
            <div class="input-group">
                <input class="form-control" name="keyword" type="text" placeholder="Cari Artikel..." value="{{ request('keyword') }}">
                <button class="btn btn-primary" id="button-search" type="submit">Cari</button>
            </div>
        </form>
    </div>
    <div class="row">
        <!-- Main Content Area -->
        @foreach ($articles as $item)
        <div class="col-4" data-aos="flip-up">
               <!-- Blog post-->
               <div class="card  mb-4 shadow-sm">
                <a href="{{ url('p/'.$item->slug) }}">
                    <img class="card-img-top post-img" src="{{ asset('storage/back/'.$item->img) }}" alt="Deskripsi gambar" />
                </a>
                                                <div class="card-body card-height">
                    <div class="small text-muted">
                        {{ $item->created_at->format('d-m-Y') }}  
                        <br>
                        {{($item->Category)->name }}
                    </div>             

                    <h2 class="card-title h4">{{ $item->title }}</h2>
                    <p class="card-text">{!! Str::words($item->desc, 15, '.....') !!}</p>
                    <a class="btn btn-primary" href="{{ url('p/'.$item->slug) }}">Read more →</a>
                </div>
            </div>
            <!-- Blog post-->
        </div>
           @endforeach
        
       
        
    </div>



    {{ $articles->links() }}

</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('berita/js/script.js') }}"></script>

@endsection
