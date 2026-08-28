@extends('rpro.blog_master')

@section('content')
        <section class="relative w-full bg-white relative bg-[linear-gradient(115deg,var(--tw-gradient-stops))] from-[#fff8e7] from-28% via-[#f7c7e4] via-70% to-[#d4b0ff] sm:bg-[linear-gradient(145deg,var(--tw-gradient-stops))]" x-data="{ showMenu: false }" data-tails-scripts="//unpkg.com/alpinejs">
            @include('rpro.nav')
            @php
                $post = json_decode($data)->data;
            @endphp
            
            <!-- Blog Post Hero Section -->
            <div class="px-4 py-20 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-24">
                <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                    <h1 class="max-w-lg mb-6 font-sans text-4xl font-bold leading-none tracking-tight text-gray-900 sm:text-5xl md:mx-auto">
                        {{ $post->title }}
                    </h1>
                    <p class="text-base text-gray-700 md:text-lg">
                        <time datetime="{{ $post->created_at }}">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}
                        </time>
                        <span class="mx-2">•</span>
                        <span>{{ $post->read_time ?? '5' }} {{ __('min read') }}</span>
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Blog Post Content -->
        <div class="flex-1 min-h-screen bg-gray-50">
            <div class="bg-linear-to-t from-gray-100 pb-14">
                <article class="px-6 py-8 mx-auto max-w-4xl">
                    

                    @if(isset($post) && $post)
                        <!-- Blog post header -->
                        <header class="mb-8">
                           
                            <img src="{{ $post->featured_image }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-auto rounded-xl object-cover mb-8">
                        </header>

                        <!-- Blog post content -->
                        <div class="prose prose-lg max-w-none text-gray-700">
                            {!! $post->content !!}
                        </div>

                        <!-- Social share buttons -->
                        <div class="flex justify-center space-x-4 my-12 border-t border-gray-200 pt-8">
                            <h3 class="mr-4 font-medium text-gray-700">{{ __('Share this post:') }}</h3>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                               target="_blank" 
                               class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fab fa-facebook-square text-2xl"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" 
                               target="_blank" 
                               class="text-blue-400 hover:text-blue-600 mr-2">
                                <i class="fab fa-twitter text-2xl"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" 
                               target="_blank" 
                               class="text-blue-700 hover:text-blue-900 mr-2">
                                <i class="fab fa-linkedin text-2xl"></i>
                            </a>
                        </div>

                        <!-- Disqus Comments -->
                        <div id="disqus_thread" class="my-12"></div>
                        <script>
                            var disqus_config = function () {
                                this.page.url = '{{ url()->current() }}';
                                this.page.identifier = '{{ Request::path() }}';
                            };
                            (function() {
                                var d = document, s = d.createElement('script');
                                s.src = 'https://{{ config('blog.disqus_shortname') }}.disqus.com'; // Replace with your Disqus shortname
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    @else
                        <div class="text-center py-12">
                            <h2 class="text-2xl font-bold text-gray-800">{{ __('Blog post not found') }}</h2>
                            <p class="mt-4 text-gray-600">{{ __('The blog post you are looking for might have been removed or is temporarily unavailable.') }}</p>
                            <a href="/blog" class="mt-8 inline-block px-6 py-3 bg-gray-900 text-white rounded-md font-medium hover:bg-gray-800">
                                {{ __('Back to Blog') }}
                            </a>
                        </div>
                    @endif
                </article>
            </div>
        </div>

        @include('rpro.footer')
    </div>

    <!-- Alpine.js initialization -->
    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');
        });
        
        if (typeof Alpine === 'undefined') {
            console.error('Alpine.js is not loaded. Adding it now.');
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js';
            script.defer = true;
            document.head.appendChild(script);
        }
    </script>
    
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
@endsection
