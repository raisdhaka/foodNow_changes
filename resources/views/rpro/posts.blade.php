<div class="mt-16 bg-linear-to-t from-gray-100 pb-14">
    <div class="px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-7xl">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-medium tracking-tight">{{ __('Blog posts') }}</h2>
                <a href="/blog" class="text-gray-900 font-medium hover:underline">{{ __('View all posts') }} &rarr;</a>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-3"
                 x-data="{ 
                    posts: [],
                    async fetchPosts() {
                        try {
                            const response = await fetch('/api/blog?limit=3');
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            const data = await response.json();
                            console.log('API call to get posts');
                            console.log(data);
                            if (data.status) {
                                this.posts = data.data;
                            }
                        } catch (error) {
                            console.error('Error fetching posts:', error);
                        }
                    }
                 }"
                 x-init="$nextTick(() => fetchPosts())">
                
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
            </div>
        </div>
    </div>
</div>

<!-- Make sure Alpine.js is properly loaded -->
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
