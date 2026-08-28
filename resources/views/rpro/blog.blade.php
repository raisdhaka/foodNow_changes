@extends('rpro.blog_master')

@section('content')
        <section class="relative w-full bg-white relative bg-[linear-gradient(115deg,var(--tw-gradient-stops))] from-[#fff8e7] from-28% via-[#f7c7e4] via-70% to-[#d4b0ff] sm:bg-[linear-gradient(145deg,var(--tw-gradient-stops))]" x-data="{ showMenu: false }" data-tails-scripts="//unpkg.com/alpinejs">
            @include('rpro.nav')
            <!-- Blog Hero Section -->
            <div class="px-4 py-20 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-24">
                <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                    <h1 class="max-w-lg mb-6 font-sans text-4xl font-bold leading-none tracking-tight text-gray-900 sm:text-5xl md:mx-auto">
                        {{ __('Blog') }}
                    </h1>
                    <p class="text-base text-gray-700 md:text-lg">
                        {{ __('Discover the latest insights, tips, and news') }}
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Blog Content Section -->
        <section class="bg-white py-16">
            <div class="px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-7xl">
                    <div id="blog-posts-container"
                         x-data="{ 
                            posts: [],
                            pagination: {},
                            currentPage: 1,
                            async fetchPosts(page = 1) {
                                try {
                                    const response = await fetch(`/api/blog?page=${page}&limit=9`);
                                    const data = await response.json();
                                    if (data.status) {
                                        this.posts = data.data;
                                        this.pagination = data.pagination;
                                        this.currentPage = parseInt(data.pagination.current_page);
                                    }
                                } catch (error) {
                                    console.error('Error fetching posts:', error);
                                }
                            }
                         }"
                         x-init="fetchPosts()">
                        
                        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-3">
                            <template x-for="post in posts" :key="post.id">
                                <div class="relative flex flex-col rounded-3xl bg-white p-2 ring-1 shadow-md shadow-black/5 ring-black/5">
                                    <img :src="post.featured_image" class="aspect-3/2 w-full rounded-2xl object-cover" :alt="post.title">
                                    <div class="flex flex-1 flex-col p-8">
                                        <div class="text-sm/5 text-gray-700" x-text="new Date(post.created_at).toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' })"></div>
                                        <div class="mt-2 text-base/7 font-medium">
                                            <a :href="'/blog/' + post.slug">
                                                <span class="absolute inset-0"></span>
                                                <span x-text="post.title"></span>
                                            </a>
                                        </div>
                                        <div class="mt-2 flex-1 text-sm/6 text-gray-500" x-text="post.excerpt"></div>
                                       
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Fallback for when posts are loading or if there's an error -->
                        <template x-if="posts.length === 0">
                            <div class="col-span-3 py-10 text-center">
                                <div class="animate-pulse flex flex-col items-center">
                                    <div class="h-8 bg-gray-200 rounded w-1/4 mb-4"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2 mb-2.5"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                                </div>
                            </div>
                        </template>

                        <!-- Pagination -->
                        <div class="flex justify-center mt-12">
                            <nav class="flex items-center space-x-2" aria-label="Pagination">
                                <!-- Previous button -->
                                <button 
                                    @click="fetchPosts(currentPage - 1)"
                                    :disabled="currentPage === 1"
                                    :class="{'opacity-50 cursor-not-allowed': currentPage === 1}"
                                    class="px-3 py-2 rounded-md bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    {{ __('Previous') }}
                                </button>
                                
                                <!-- Page numbers -->
                                <template x-for="page in parseInt(pagination.last_page)" :key="page">
                                    <button 
                                        @click="fetchPosts(page)"
                                        :class="{'bg-gray-900 text-white': currentPage === page, 'bg-white text-gray-700': currentPage !== page}"
                                        class="px-4 py-2 rounded-md border border-gray-300 text-sm font-medium hover:bg-gray-50"
                                        x-text="page">
                                    </button>
                                </template>

                                <!-- Next button -->
                                <button 
                                    @click="fetchPosts(currentPage + 1)"
                                    :disabled="currentPage === parseInt(pagination.last_page)"
                                    :class="{'opacity-50 cursor-not-allowed': currentPage === parseInt(pagination.last_page)}"
                                    class="px-3 py-2 rounded-md bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    {{ __('Next') }}
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
@endsection