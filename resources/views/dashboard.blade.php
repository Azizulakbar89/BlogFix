@extends('layouts1.template')

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div id="hot-post" class="row hot-post">
                @if ($blogs)
                    <div class="col-md-8 hot-post-left">
                        <!-- post -->
                        <div class="post post-thumb">
                            <a class="post-img" href={{ route('artikel.show', $blogs->idArtikel) }}>
                                <img src="{{ asset('storage/' . $blogs->gambar) }}" alt=""
                                    style="width: 100%; height: 505px; object-fit: cover; border-radius: 10px;">
                            </a>
                            <div class="post-body">
                                <div class="post-category">
                                    <a
                                        href={{ route('kategori.detail', $blogs->idKategori) }}>{{ $blogs->kategoris->kategori }}</a>
                                </div>
                                <h3 class="post-title title-lg"><a>{{ $blogs->judul }}</a></h3>
                                <ul class="post-meta">
                                    <li><a>{{ $blogs->users->name }}</a></li>
                                    <li>{{ $blogs->created_at ? $blogs->created_at->format('d F Y') : 'No date available' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /post -->
                    </div>
                @endif

                <div class="col-md-4 hot-post-right">
                    <!-- post -->
                    @foreach ($blogss as $blog)
                        <div class="post post-thumb">

                            <a class="post-img" href={{ route('artikel.show', $blog->idArtikel) }}>
                                <img src="{{ asset('storage/' . $blog->gambar) }}" alt=""
                                    style="width: 100%; height: 250px; object-fit: cover;">
                            </a>
                            <div class="post-body">
                                <div class="post-category">
                                    <a
                                        href={{ route('kategori.detail', $blog->idKategori) }}>{{ $blog->kategoris->kategori }}</a>
                                </div>
                                <h3 class="post-title"><a>{{ $blog->judul }}</a></h3>
                                <ul class="post-meta">
                                    <li><a>{{ $blog->users->name }}</a></li>
                                    <li>{{ $blogs->created_at ? $blog->created_at->format('d F Y') : 'No date available' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    <!-- /post -->

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="title">Recent posts</h2>
                            </div>
                        </div>
                        <!-- post -->
                        @foreach ($recent as $baru)
                            <div class="col-md-6">
                                <div class="post">
                                    <a class="post-img" href={{ route('artikel.show', $baru->idArtikel) }}><img
                                            src="{{ asset('storage/' . $baru->gambar) }}" alt=""
                                            style="width: 100%; height: 250px; object-fit: cover;"></a>
                                    <div class="post-body">
                                        <div class="post-category">
                                            <a
                                                href={{ route('kategori.detail', $baru->idKategori) }}>{{ $baru->kategoris->kategori }}</a>
                                        </div>
                                        <h3 class="post-title"><a>{{ $baru->judul }}</a></h3>
                                        <ul class="post-meta">
                                            <li><a>{{ $baru->users->name }}</a></li>
                                            <li>{{ $baru->created_at ? $baru->created_at->format('d F Y') : 'No date available' }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- /post -->
                    </div>
                    <!-- /row -->
                </div>

                <div class="col-md-4">
                    <!-- social widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2 class="title">Social Media</h2>
                        </div>
                        <div class="social-widget">
                            <ul>
                                <li>
                                    <a href="#" class="social-facebook">
                                        <i class="fa fa-facebook"></i>
                                        <span>21.2K<br>Followers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-twitter">
                                        <i class="fa fa-twitter"></i>
                                        <span>10.2K<br>Followers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-google-plus">
                                        <i class="fa fa-google-plus"></i>
                                        <span>5K<br>Followers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /social widget -->

                    <!-- post widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2 class="title">Popular Posts</h2>
                        </div>
                        <!-- post -->
                        @foreach ($popular as $gacor)
                            <div class="post post-widget">
                                <a class="post-img" href={{ route('artikel.show', $gacor->idArtikel) }}><img
                                        src="{{ asset('storage/' . $gacor->gambar) }}" alt=""
                                        style="width: 100%; height: 120px; object-fit: cover;"></a>
                                <div class="post-body">
                                    <div class="post-category">
                                        <a
                                            href={{ route('kategori.detail', $gacor->idKategori) }}>{{ $gacor->kategoris->kategori }}</a>
                                    </div>
                                    <h3 class="post-title"><a
                                            href={{ route('artikel.show', $gacor->idArtikel) }}></a>{{ $gacor->judul }}
                                    </h3>
                                    <ul class="post-meta">
                                        <li><a>{{ $gacor->users->name }}</a></li>
                                        <li>Rating: {{ $gacor->avg_rating }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        <!-- /post -->

                    </div>
                    <!-- /post widget -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->



    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- post -->
                    @foreach ($artikel as $haha)
                        <div class="post post-row">

                            <a class="post-img" href={{ route('artikel.show', $haha->idArtikel) }}><img
                                    src="{{ asset('storage/' . $haha->gambar) }}" alt=""
                                    style="width: 100%; height: 300px; object-fit: cover;"></a>
                            <div class="post-body">
                                <div class="post-category">
                                    <a
                                        href={{ route('kategori.detail', $haha->idKategori) }}>{{ $haha->kategoris->kategori }}</a>
                                </div>
                                <h3 class="post-title"><a
                                        href={{ route('artikel.show', $haha->idArtikel) }}>{{ $haha->judul }}</a></h3>
                                <ul class="post-meta">
                                    <li><a>{{ $haha->users->name }}</a></li>
                                    <li>{{ $haha->created_at ? $haha->created_at->format('d F Y') : 'No date available' }}
                                </ul>
                                @if (!empty($haha->deskripsi))
                                    @foreach (array_slice(explode("\n", $haha->deskripsi), 0, 1) as $paragraph)
                                        <div>
                                            {!! \Illuminate\Support\Str::words($paragraph, 50, '...') !!}
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-muted">Tidak ada deskripsi.</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <!-- /post -->

                    <div class="pagination justify-content-center" style="margin-left: 90rem">
                        {{ $artikel->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
