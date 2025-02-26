@extends('layouts1.template')
<style>
    .rating {
        font-size: 24px;
        color: #ccc;
        cursor: pointer;
    }

    .rating .star {
        display: inline-block;
    }

    .rating .star.active,
    .rating .star:hover {
        color: #ffcc00;
    }
</style>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@section('content')

    <body>
        <!-- HEADER -->
        <header id="header">
            <!-- PAGE HEADER -->
            <div id="post-header" class="page-header">
                <div class="page-header-bg"
                    style="
                background-image: url('{{ $artikel->gambar ? asset('/storage/gambar/' . $artikel->gambar) : asset('/img/header-1.jpg') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                width: 100%;
                height: 100vh; /* Gunakan viewport height untuk full screen */
                position: absolute;"
                    data-stellar-background-ratio="0.5">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="post-category">
                                <a href="category.html">{{ $artikel->kategori->kategori }}</a>
                            </div>
                            <h1>{{ $artikel->judul }}</h1>
                            <ul class="post-meta">
                                <li><a href="author.html">{{ $artikel->users->name }}</a></li>
                                <li>{{ $artikel->created_at ? $artikel->created_at->format('d F Y') : 'No date available' }}
                                <li><i class="fa fa-comments"></i> {{ $jumlahKomentar }}</li>

                                <li><i class="fa fa-star"></i> {{ $artikel->avg_rating }}</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /PAGE HEADER -->
        </header>
        <!-- /HEADER -->

        <!-- section -->
        <div class="section" style="margin-top:40rem">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-8">
                        <!-- post share -->
                        <div class="section-row">
                            <div class="post-share">
                                <a href="#" class="social-facebook"><i
                                        class="fa fa-facebook"></i><span>Share</span></a>
                                <a href="#" class="social-twitter"><i class="fa fa-twitter"></i><span>Tweet</span></a>
                                <a href="#" class="social-pinterest"><i
                                        class="fa fa-pinterest"></i><span>Pin</span></a>
                                <a href="#"><i class="fa fa-envelope"></i><span>Email</span></a>
                            </div>
                        </div>
                        <!-- /post share -->

                        <!-- post content -->
                        <div class="section-row">
                            {!! $artikel->deskripsi !!}
                        </div>
                        <!-- /post content -->
                        <!-- post reply -->
                        <div class="section-row">
                            <div class="section-title">
                                <h3 class="title">Leave a reply</h3>
                            </div>
                            <form class="post-reply" action="{{ route('komentar.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="idArtikel" value="{{ $artikel->idArtikel }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="input" name="komentar" placeholder="Message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="rating">Rating:</label>
                                            <div class="rating">
                                                <span class="star" data-value="1">&#9733;</span>
                                                <span class="star" data-value="2">&#9733;</span>
                                                <span class="star" data-value="3">&#9733;</span>
                                                <span class="star" data-value="4">&#9733;</span>
                                                <span class="star" data-value="5">&#9733;</span>
                                            </div>
                                            <input type="hidden" name="rating" id="rating-value" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="primary-button">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /post reply -->
                        <!-- post comments -->
                        <div class="section-row">
                            <div class="section-title">
                                <h3 class="title">{{ $jumlahKomentar }} Comments</h3>
                            </div>
                            <div class="post-comments">
                                <!-- comment -->
                                <div class="media">
                                    <div class="media-left">
                                        <img class="media-object" src="./img/avatar-2.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        @foreach ($komentars as $item)
                                            <div class="media-heading">
                                                <h4>{{ $item->user->name }}</h4>
                                                <span
                                                    class="time">{{ $item->created_at ? $item->created_at->format('d F Y') : 'No date available' }}</span>
                                            </div>
                                            <p>{{ $item->komentar }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /comment -->
                            </div>
                        </div>
                        <!-- /post comments -->
                    </div>
                    <div class="col-md-4">
                        <!-- post widget -->
                        <div class="aside-widget">
                            <div class="section-title">
                                <h2 class="title">Popular Posts</h2>
                            </div>
                            <!-- post -->
                            @foreach ($popular as $gacor)
                                <div class="post post-widget">
                                    <a class="post-img" href={{ route('artikel.show', $gacor->idArtikel) }}><img
                                            src="{{ asset('/storage/gambar/' . $gacor->gambar) }}" alt=""
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
                                            <li>Rating: {{ $gacor->avg_rating }}</li>
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
    </body>

    </html>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan toast jika ada session success
            @if (session('success'))
                toastr.success("{{ session('success') }}", 'Berhasil!', {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: 5000, // Toast akan hilang setelah 5 detik
                });
            @endif

            // Tampilkan toast jika ada session error
            @if (session('error'))
                toastr.error("{{ session('error') }}", 'Gagal!', {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: 5000, // Toast akan hilang setelah 5 detik
                });
            @endif

            // Script untuk rating bintang
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating-value');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    ratingInput.value = value;

                    // Update tampilan bintang
                    stars.forEach(s => s.classList.remove('active'));
                    this.classList.add('active');
                    let prevStar = this.previousElementSibling;
                    while (prevStar) {
                        prevStar.classList.add('active');
                        prevStar = prevStar.previousElementSibling;
                    }
                });
            });
        });
    </script>
@endsection
