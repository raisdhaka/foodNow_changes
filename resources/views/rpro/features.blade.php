<div class="bg-linear-to-b from-white from-50% to-gray-100 py-32" id="features">
    <div class="px-6 lg:px-2">
        <div class="mx-auto max-w-2xl lg:max-w-7xl">
            <h2
                class="font-mono text-xs/5 font-semibold tracking-widest text-gray-500 uppercase data-dark:text-gray-400">
                {{ __('Features') }}</h2>
            <h3
                class="mt-2 max-w-3xl text-4xl font-medium tracking-tighter text-pretty text-gray-950 data-dark:text-white sm:text-6xl">
                {{ __('Everything you need to run your restaurant.') }}</h3>
            <div class="mt-10 grid grid-cols-1 gap-4 sm:mt-16 lg:grid-cols-6">
                @foreach($features as $index => $feature)
                
                <div
                    class="lg:col-span-3 {{ $index === 0 ? 'max-lg:rounded-t-4xl lg:rounded-tl-4xl' : '' }} {{ $index === 1 ? 'lg:rounded-tr-4xl' : '' }} group relative flex flex-col overflow-hidden rounded-lg bg-white ring-1 shadow-xs ring-black/5 data-dark:bg-gray-800 data-dark:ring-white/15">
                    <div class="relative h-80 shrink-0">
                        <div
                            class="h-80 bg-no-repeat bg-cover bg-center"
                            style="background-image: url('{{ $feature->image_link }}');">
                        </div>
                    </div>
                  
                    <div class="relative p-10">
                        <h3
                            class="font-mono text-xs/5 font-semibold tracking-widest text-gray-500 uppercase data-dark:text-gray-400">
                            {{ $feature->subtitle }}</h3>
                        <p class="mt-1 text-2xl/8 font-medium tracking-tight text-gray-950 group-data-dark:text-white">
                            {{ $feature->title }}</p>
                        <p class="mt-2 max-w-[600px] text-sm/6 text-gray-600 group-data-dark:text-gray-400">{{ $feature->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
