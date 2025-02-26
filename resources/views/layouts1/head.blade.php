<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Jijul Article</title>

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
