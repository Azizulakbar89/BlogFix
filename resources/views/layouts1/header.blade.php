<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Callie HTML Template</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css') }} " />

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/assets/css/style.css') }}" />

    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Include the TailwindCSS library on your page -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  
  <![endif]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>

<body>
    <!-- HEADER -->
    <header id="header">
        <!-- NAV -->
        <div id="nav">
            <!-- Top Nav -->
            <div id="nav-top">
                <div class="container">
                    <!-- social -->
                    <ul class="nav-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                    <!-- /social -->

                    <!-- logo -->
                    <div class="nav-logo" style="margin-top: 2rem">
                        {{-- <a href="index.html" class="logo"><img src="{{ asset('/assets/img/logo.png') }}"
                                alt=""></a> --}}
                        <h1 x-data="{
                            startingAnimation: { opacity: 0, scale: 4 },
                            endingAnimation: { opacity: 1, scale: 1, stagger: 0.07, duration: 1, ease: 'expo.out' },
                            addCNDScript: true,
                            animateText() {
                                $el.classList.remove('invisible');
                                gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);
                            },
                            splitCharactersIntoSpans(element) {
                                text = element.innerHTML;
                                modifiedHTML = [];
                                for (var i = 0; i < text.length; i++) {
                                    attributes = '';
                                    if (text[i].trim()) { attributes = 'class=\'inline-block\''; }
                                    modifiedHTML.push('<span ' + attributes + '>' + text[i] + '</span>');
                                }
                                element.innerHTML = modifiedHTML.join('');
                            },
                            addScriptToHead(url) {
                                script = document.createElement('script');
                                script.src = url;
                                document.head.appendChild(script);
                            }
                        }" x-init="splitCharactersIntoSpans($el);
                        if (addCNDScript) {
                            addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
                        }
                        gsapInterval = setInterval(function() {
                            if (typeof gsap !== 'undefined') {
                                animateText();
                                clearInterval(gsapInterval);
                            }
                        }, 5);"
                            class="invisible block text-3xl font-bold custom-font">
                            Article Jijul
                        </h1>
                    </div>
                    <!-- /logo -->


                    <!-- search & aside toggle -->
                    <div class="nav-btns">
                        <button class="aside-btn"><i class="fa fa-bars"></i></button>
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                        <div id="nav-search">
                            <form>
                                <input class="input" name="search" placeholder="Enter your search...">
                            </form>
                            <button class="nav-close search-close">
                                <span></span>
                            </button>
                        </div>
                    </div>
                    <!-- /search & aside toggle -->
                </div>
            </div>
            <!-- /Top Nav -->
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
                                                                        <a
                                                                            href="category.html">{{ $item->kategoris->kategori }}</a>
                                                                    </div>
                                                                    <h3 class="post-title title-sm"><a
                                                                            href="blog-post.html">{{ $item->judul }}</a>
                                                                    </h3>
                                                                    <ul class="post-meta">
                                                                        <li><a
                                                                                href="author.html">{{ $item->users->name }}</a>
                                                                        </li>
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
                            @auth
                                <a href="#">{{ Auth::user()->name }}</a>
                            @else
                                <a href="{{ route('login') }}">Login</a>
                            @endauth

                            <div class="dropdown">
                                <div class="dropdown-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (Route::has('login'))
                                                <nav class="-mx-3 flex flex-1 justify-end items-center space-x-4">
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
                                                                    <div><x-dropdown-link :href="route('myblog')">
                                                                            {{ __('My Blog') }}
                                                                        </x-dropdown-link></div>
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
                                                        <div></div>
                                                        @if (Route::has('register'))
                                                            <a href="{{ route('register') }}"
                                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                                Register
                                                            </a>
                                                        @endif
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
