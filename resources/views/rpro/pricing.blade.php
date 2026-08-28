<section class="py-16 bg-zinc-100" id="pricing">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold text-zinc-900 sm:text-center lg:text-5xl">{{ __('Pricing Plans') }}</h1>
        <p class="mt-3 text-lg text-zinc-500 sm:text-center lg:text-xl">{{ __('Everything you need to help you succeed. Simple transparent pricing to fit businesses of any size.') }}</p>
        
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Dynamic Plans -->
            @foreach ($plans as $plan)
                <div class="-m-2 ">
                    <div class="grid grid-cols-1 rounded-4xl p-2 shadow-md shadow-black/5">
                        <div class="rounded-3xl bg-white p-10 pb-9 ring-1 shadow-2xl ring-black/5">
                            <h2 class="font-mono text-xs font-semibold tracking-widest text-gray-500 uppercase">{{ $plan['name'] }}</h2>
                            <p class="mt-2 text-sm/6 text-gray-950/75">{{ $plan['description'] }}</p>
                            
                            <div class="mt-8 flex items-center gap-4">
                                <div class="text-5xl font-medium text-gray-950">{{ config('money')[strtoupper(config('settings.cashier_currency'))]['symbol'] }}{{ $plan['price'] }}</div>
                                <div class="text-sm/5 text-gray-950/75">
                                    <p>{{ strtoupper(config('settings.cashier_currency')) }}</p>
                                    <p>{{ __('per') }} {{ $plan['period'] == 1 ? __('month') : __('year') }}</p>
                                </div>
                            </div>

                            <div class="mt-8">
                                <a href="{{ route('newrestaurant.register') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-full border border-transparent bg-gray-950 shadow-md text-base font-medium text-white hover:bg-gray-800">
                                    {{ $plan['price'] > 0 ? __('Get started') : __('Start for free') }}
                                </a>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-sm/6 font-medium text-gray-950">{{ __('Features include:') }}</h3>
                                <ul class="mt-3 space-y-3">
                                    @foreach (explode(",", $plan['features']) as $feature)
                                    <li class="flex items-start gap-4 text-sm/6 text-gray-950/75">
                                        <span class="inline-flex h-6 items-center">
                                            <svg viewBox="0 0 15 15" aria-hidden="true" class="size-[0.9375rem] shrink-0 fill-gray-950/25">
                                                <path clip-rule="evenodd" d="M8 0H7v7H0v1h7v7h1V8h7V7H8V0z"/>
                                            </svg>
                                        </span>
                                        {{ trim($feature) }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>