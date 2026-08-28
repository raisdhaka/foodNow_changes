@extends('rpro.blog_master')

@section('content')
    <section class="relative w-full bg-white relative bg-[linear-gradient(115deg,var(--tw-gradient-stops))] from-[#fff8e7] from-28% via-[#f7c7e4] via-70% to-[#d4b0ff] sm:bg-[linear-gradient(145deg,var(--tw-gradient-stops))]" x-data="{ showMenu: false }" data-tails-scripts="//unpkg.com/alpinejs">
        @include('rpro.nav')
        <div class="px-4 py-20 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-24">
            <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                <h1 class="max-w-lg mb-6 font-sans text-4xl font-bold leading-none tracking-tight text-gray-900 sm:text-5xl md:mx-auto">
                    {{ $page->title }}
                </h1>
                @if(isset($page->created_at))
                <p class="text-base text-gray-700 md:text-lg">
                    <time datetime="{{ $page->created_at }}">
                        {{ \Carbon\Carbon::parse($page->created_at)->format('F j, Y') }}
                    </time>
                </p>
                @endif
            </div>
        </div>
    </section>
    
    <!-- Page Content -->
    <div class="flex-1 min-h-screen bg-gray-50">
        <div class="bg-linear-to-t from-gray-100 pb-14">
            <article class="px-6 py-8 mx-auto max-w-4xl">
                @if(isset($page->image) && $page->image)
                    <header class="mb-8">
                        <img src="{{ $page->image }}" 
                             alt="{{ $page->title }}" 
                             class="w-full h-auto rounded-xl object-cover mb-8">
                    </header>
                @endif

                <!-- Page content -->
                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! $page->content !!}
                </div>

               
            </article>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
@endsection
