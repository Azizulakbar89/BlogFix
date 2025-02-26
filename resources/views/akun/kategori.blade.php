@extends('layouts1.temp')

@section('content')
    <!-- Main Nav -->
    <div id="nav-bottom">
        <div class="container">
            <!-- nav -->
            <ul class="nav-menu">
                <li>
                    <a href="/">Home</a>
                </li>
                <li class="has-dropdown megamenu">
                    <a href="#">Category</a>
                    <div class="dropdown tab-dropdown">
                        <div class="row">
                            <div class="col-md-2">
                                <ul class="tab-nav">
                                    @foreach ($kategori as $kat)
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('kategori.detail', $kat->idKategori) }}">{{ $kat->kategori }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <div class="dropdown-body tab-content">
                                    <!-- tab1 -->
                                    <div id="tab1" class="tab-pane fade in active">
                                        <div class="row">

                                            <!-- post -->
                                            @foreach ($recent1 as $item)
                                                <div class="col-md-4">
                                                    <div class="post post-sm">
                                                        <a class="post-img" href="blog-post.html"><img
                                                                src="{{ asset('storage/gambar/' . $item->gambar) }}"
                                                                alt=""></a>
                                                        <div class="post-body">
                                                            <div class="post-category">
                                                                <a href="category.html">{{ $item->kategoris->kategori }}</a>
                                                            </div>
                                                            <h3 class="post-title title-sm"><a
                                                                    href="blog-post.html">{{ $item->judul }}</a></h3>
                                                            <ul class="post-meta">
                                                                <li><a href="author.html">{{ $item->users->name }}</a></li>
                                                                <li>{{ $item->created_at ? $item->created_at->format('d F Y') : 'No date available' }}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- /post -->
                                        </div>
                                    </div>
                                    <!-- /tab1 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="has-dropdown megamenu">
                    <a href="#">{{ Auth::user()->name }}</a>

                    <div class="dropdown">
                        <div class="dropdown-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if (Route::has('login'))
                                        <nav class="-mx-3 flex flex-1 justify-end items-center space-x-4">
                                            @auth
                                                <!-- Dropdown Menu -->
                                                <div class="relative">
                                                    <!-- Dropdown Content -->
                                                    <div
                                                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                        <div class="py-1">
                                                            <!-- Profile Link -->
                                                            <x-dropdown-link :href="route('profile.edit')">
                                                                {{ __('Profile') }}
                                                            </x-dropdown-link>
                                                            <div>
                                                                <x-dropdown-link :href="route('myblog')">
                                                                    {{ __('My Blog') }}
                                                                </x-dropdown-link>

                                                            </div>

                                                            <!-- Logout Form -->
                                                            <form method="POST" action="{{ route('logout') }}">
                                                                @csrf
                                                                <x-dropdown-link :href="route('logout')"
                                                                    onclick="event.preventDefault();this.closest('form').submit();">
                                                                    {{ __('Log Out') }}
                                                                </x-dropdown-link>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endauth
                                        </nav>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="/blog">Create Blog</a>
                </li>
            </ul>
            <!-- /nav -->
        </div>
    </div>
    <!-- /Main Nav -->
    <div class="container">
        <h1>Tambah Kategori</h1>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kategori">Nama Kategori:</label>
                <input type="text" name="kategori" id="kategori" class="form-control" required>
                @error('kategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
