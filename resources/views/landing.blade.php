<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name','RPRO') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('vendor') }}/tailwind/tailwind.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link type="text/css" href="{{ asset('impactfront') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Logo CSS -->
    <style>
        /* By default, show the light logo and hide the dark logo */
        .navbar-brand-light { display: inline-block; }
        .navbar-brand-dark { display: none; }
        
        /* On dark background or when dark mode is active, show the dark logo and hide the light logo */
        @media (prefers-color-scheme: dark) {
            .navbar-brand-light { display: none; }
            .navbar-brand-dark { display: inline-block; }
        }
        
        /* You can also add a class to the body to toggle between light and dark modes */
        body.dark-mode .navbar-brand-light { display: none; }
        body.dark-mode .navbar-brand-dark { display: inline-block; }
        
        /* Alpine.js - Hide elements with x-cloak until Alpine is initialized */
        [x-cloak] { display: none !important; }
        
        /* CSS-only dropdown for language selector */
        .language-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .language-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0;
            padding: 8px 0;
            min-width: 160px;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            z-index: 20;
        }
        
        /* Add invisible padding to create a continuous hover area */
        .language-dropdown::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 10px;
            background: transparent;
        }
        
        .language-dropdown:hover .language-dropdown-content {
            display: block;
        }
        
        .language-dropdown-content:hover {
            display: block;
        }
        
        .language-dropdown-content a {
            display: block;
            padding: 8px 16px;
            color: #374151;
            font-size: 0.875rem;
            text-decoration: none;
        }
        
        .language-dropdown-content a:hover {
            background-color: #f3f4f6;
        }
    </style>

    <!-- Google Analitics -->
    @include('layouts.ga')
    @yield('head')
    @laravelPWA
    
    <!-- RTL and Commmon ( Phone ) -->
    @include('layouts.rtl')

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <!-- Custom CSS defined by admin -->
    <link type="text/css" href="{{ asset('byadmin') }}/front.css" rel="stylesheet">

    <link type="text/css" href="{{ asset('custom') }}/css/blob.css" rel="stylesheet">
    
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
</head>

<body class="text-gray-950 antialiased" data-new-gr-c-s-check-loaded="14.1218.0" data-gr-ext-installed="">
    <div class="overflow-hidden">
        <section class="relative w-full bg-white  relative bg-[linear-gradient(115deg,var(--tw-gradient-stops))] from-[#fff8e7] from-28% via-[#f7c7e4] via-70% to-[#d4b0ff] sm:bg-[linear-gradient(145deg,var(--tw-gradient-stops))]" x-data="{ showMenu: false }" data-tails-scripts="//unpkg.com/alpinejs">
            @include('rpro.nav')
            @include('rpro.hero')
        </section>
       
        @include('rpro.features')

        @include('rpro.pricing')
        @include('rpro.posts')
        @include('rpro.testimonials')
        @include('rpro.faq')
        @include('rpro.footer')
    </div>

    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: false,
            autoplayVideos: true,
            plyr: {
                css: 'https://cdn.plyr.io/3.7.8/plyr.css',
                js: 'https://cdn.plyr.io/3.7.8/plyr.js',
                config: {
                    ratio: '16:9',
                    youtube: {
                        noCookie: true,
                        rel: 0,
                        showinfo: 0,
                        iv_load_policy: 3
                    }
                }
            }
        });
    </script>
</body>

</html> 