@extends('layouts.main')


@push('css')
   <link rel="stylesheet" href="{{ asset('berita/css/custom.css') }}">
@endpush

@section('title', 'Category' . $category->name)

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
<div class="container">
    <div class="mb-5 mt-5">
        <form action="{{ route('search') }}" class="d-flex justify-content-between" method='GET'>
            <div class="input-group">
                <input class="form-control" name="keyword" type="text" placeholder="Cari Artikel..." value="{{ request('keyword') }}">
                <button class="btn btn-primary" id="button-search" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <!-- Menampilkan kategori dengan benar -->
    <p>Showing article with category: <b>{{ $category->name }}</b></p>

    <div class="row">
        <!-- Main Content Area -->
        @foreach ($articles as $item)
        <div class="col-4"data-aos="flip-up">
               <!-- Blog post-->
               <div class="card  mb-4 shadow-sm">
                <a href="{{ url('p/'.$item->slug) }}">
                    <img class="card-img-top post-img" src="{{ asset('storage/uploads/articles/'.$item->img) }}" alt="Deskripsi gambar" />
                </a>
                <div class="card-body card-height">
                    <div class="small text-muted">
                        <span class="ml-2">{{ $item->created_at->format('d-m-Y') }}</span>
                        <span>
                            <a href=""></a>
                            {{ optional($item->kategori)->nama ?? 'Tanpa Kategori' }}
                        </span>
                        <span>
                            Views : {{ $item->views }} <!-- Menampilkan jumlah views -->
                        </span>
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

    <!-- Pagination -->
    {{ $articles->links() }}

</div>


<!-- Bootstrap JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}

<!-- Custom JS -->
<script src="{{ asset('berita/js/script.js') }}"></script>

@endsection
