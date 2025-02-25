@extends('layouts1.temp')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
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

    <!-- Aside Nav -->
    <div id="nav-aside">
        <ul class="nav-aside-menu">
            <li><a href="{{ url('/') }}">Home</a></li>

            <!-- Categories Dropdown -->
            <li class="has-dropdown">
                <a>Categories</a>
                @isset($kategori)
                    <ul class="dropdown">
                        @foreach ($kategori as $kat)
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('kategori.detail', $kat->idKategori) }}">{{ $kat->kategori }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endisset
            </li>

            <li><a href="{{ url('/blog') }}">Create Blog</a></li>

            <!-- Authentication Links -->
            <li>
                @if (Route::has('login'))
                    <div class="dropdown-body">
                        <div class="row">
                            <div class="col-md-12">
                                <nav class="flex justify-end items-center space-x-4">
                                    @auth
                                        <!-- Jika sudah login, tampilkan dropdown profile -->
                                        <div class="relative">
                                            <!-- Dropdown Content -->
                                            <div
                                                class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                <div class="py-1">
                                                    <x-dropdown-link :href="route('profile.edit')">
                                                        {{ __('Profile') }}
                                                    </x-dropdown-link>

                                                    <x-dropdown-link :href="route('myblog')">
                                                        {{ __('My Blog') }}
                                                    </x-dropdown-link>

                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <x-dropdown-link :href="route('logout')"
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                            {{ __('Log Out') }}
                                                        </x-dropdown-link>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Jika belum login, tampilkan Login dan Register -->
                                        <a href="{{ route('login') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Log in
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                </nav>
                            </div>
                        </div>
                    </div>
                @endif
            </li>
        </ul>

        <!-- Close Button -->
        <button class="nav-close nav-aside-close"><span></span></button>
    </div>
    <!-- /Aside Nav -->
    </div>
    <!-- /NAV -->
    </header>
    <!-- /HEADER -->


    <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" style="margin-left: 15rem; margin-right: 13rem;">
            <!-- Input Judul -->
            <div class="col-md-12" style="margin-top: 3rem">
                <input class="input" type="text" name="judul" id="judul" placeholder="Judul"
                    value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Select Button (Dropdown) -->
            <div class="col-md-12" style="margin-top: 3rem">
                <select class="input" name="idKategori" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->idKategori }}"
                            {{ old('idKategori') == $kategori->idKategori ? 'selected' : '' }}>{{ $kategori->kategori }}
                        </option>
                    @endforeach
                </select>
                @error('idKategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12" style="margin-top: 3rem">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" name="image" id="img"
                    class="form-control @error('image')
                    is-invalid @enderror"
                    value="{{ old('image') }}" onchange="previewImage()">

                <img class="img-preview img-fluid mb-3 col-sm-7">
                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12" style="margin-top: 3rem">

                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi"></textarea>
                <input type="hidden" name="deskripsi_validasi" id="deskripsi_validasi" required>
            </div>

            <!-- Submit Button -->
            <div class="col-md-12" style="margin-top: 3rem">
                <button type="submit" class="primary-button">Submit</button>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editor;

            // Inisialisasi CKEditor
            ClassicEditor
                .create(document.querySelector('#deskripsi'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                            'alignment', '|',
                            'numberedList', 'bulletedList', '|',
                            'outdent', 'indent', '|',
                            'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'undo', 'redo', '|',
                            'code', 'codeBlock', '|',
                            'horizontalLine', 'pageBreak', '|',
                            'specialCharacters', '|',
                            'sourceEditing', '|',
                            'MathType', 'ChemType'
                        ]
                    },
                    mathTypeParameters: {
                        serviceProviderProperties: {
                            URI: 'https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image',
                            server: 'php'
                        }
                    },
                    height: 500,
                    entering: {
                        mode: 'div',
                        shiftEnterMode: 'br',
                    }
                })
                .then(instance => {
                    editor = instance;
                })
                .catch(error => {
                    console.error('Gagal menginisialisasi CKEditor:', error);
                });

            // Pastikan konten CKEditor disalin ke <textarea> sebelum form disubmit
            document.querySelector('form').addEventListener('submit', function(event) {
                if (editor) {
                    const hiddenInput = document.querySelector('#deskripsi_validasi');
                    hiddenInput.value = editor.getData();

                    if (!hiddenInput.value.trim()) {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Deskripsi wajib diisi!',
                        });
                    }
                } else {
                    console.error('CKEditor belum diinisialisasi.');
                    event.preventDefault();
                }
            });
        });

        // Fungsi untuk menampilkan preview gambar
        function previewImage() {
            const img = document.querySelector("#img");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = 'block';
            const reader = new FileReader();
            reader.readAsDataURL(img.files[0]);
            reader.onload = function(event) {
                imgPreview.src = event.target.result;
            }
        }

        // Fungsi untuk menampilkan toast SweetAlert2
        document.addEventListener("DOMContentLoaded", function() {
            let successMessage = "{{ session('success') }}";
            let errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: successMessage,
                    showConfirmButton: false,
                    timer: 3000
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    </script>
@endsection
