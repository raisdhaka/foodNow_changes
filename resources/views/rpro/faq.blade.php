<!-- Section  FAQ -->
<section id="faq" class="py-16 bg-slate-50 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl md:text-center">
            <h2 class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">{{ __('Frequently Asked Questions') }}</h2>
            <p class="mt-4 text-lg tracking-tight text-slate-700">{{ __('Common questions about our service') }}</p>
        </div>
        
        <div class="mx-auto mt-16 space-y-8">
            @foreach ($faqs as $faq)
                <div class=" pb-8 last:border-0">
                    <h4 class="font-display text-xl font-medium text-slate-900 md:text-2xl mt-4">
                        {{$faq->title}}
                    </h4>
                    <p class="mt-4 text-lg tracking-tight text-slate-700">
                        {{$faq->description}}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
