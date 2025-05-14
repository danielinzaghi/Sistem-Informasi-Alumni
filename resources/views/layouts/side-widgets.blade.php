<div class="col-lg-4" data-aos="fide-left">
    
     <div class="card mb-4">
        <div class="card-header text-center">
            <h5>Cari Artikel</h5>
        </div>
        <div class="card-body shadow-sm">
            <form action="{{ route('search') }}" class="d-flex justify-content-between" method='GET'>
                <div class="input-group">
                    <input class="form-control" name="keyword" type="text" placeholder="Cari Artikel..." value="{{ request('keyword') }}">
                    <button class="btn btn-primary" id="button-search" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div> 

    <!-- Categories widget-->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">Kategori Artikel</div>
        <div class="card-body">
            <div class="d-flex flex-wrap">
                <ul class="list-inline">
                    <ul class="list-inline">
                        @foreach ($categories as $item)
                                <li class="list-inline-item">
                                    <span class="btn btn-primary text-white m-1" style="cursor: pointer;" onclick="window.location='{{ url('category/' . $item->slug) }}'">
                                        {{ $item->nama }} ({{ $item->total_articles }})  <!-- Properti total_articles di sini -->
                                    </span>
                                </li>
                            @endforeach

                    </ul>
                    
                </ul>
                
            </div>
        </div>
    </div>

    <!-- Side widget-->
    {{-- <div class="card mb-4 shadow-sm">
        <div class="card-header">Side Widget</div>
        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
    </div> --}}
    <!-- Popular Posts -->
<div class="card mb-4 shadow-sm">
    <div class="card-header">Postingan Terpopuler</div>
    <div class="card-body">
        <div class="row">
            @foreach ($popular_posts as $item)
                <div class="col-md-12 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">
                                <img src="{{ asset('storage/uploads/articles/'.$item->img) }}" alt="{{ $item->title }}" class="img-fluid rounded">
                            </div>
                            <div class="col-9">
                                <div class="card-body px-3">
                                    <h6 class="card-title mb-0">
                                        <a href="{{ url('p/'.$item->slug) }}" class="text-primary text-decoration-none">{{ $item->judul }}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>

    
    
</div>
