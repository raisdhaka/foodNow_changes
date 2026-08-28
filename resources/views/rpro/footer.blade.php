<footer>
    <div
        class="relative  bg-[linear-gradient(115deg,var(--tw-gradient-stops))] from-[#fff1be] from-28% via-[#ee87cb] via-70% to-[#b060ff] sm:bg-[linear-gradient(145deg,var(--tw-gradient-stops))]">
        <div class="absolute inset-2 rounded-4xl bg-white/80"></div>
        <div class="px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-7xl">
                <div class="relative pt-20 pb-16 text-center sm:py-24">
                    <hgroup>
                        <h2
                            class="font-mono text-xs/5 font-semibold tracking-widest text-gray-500 uppercase data-dark:text-gray-400">
                            {{ __('Get started') }}</h2>
                        <p class="mt-6 text-3xl font-medium tracking-tight text-gray-950 sm:text-5xl">
                            {{ __('Ready to dive in?') }}<br>{{ __('Start your free trial today.') }}</p>
                    </hgroup>
                   
                    <div class="mt-6"><a
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-[calc(--spacing(2)-1px)] rounded-full border border-transparent bg-gray-950 shadow-md text-base font-medium whitespace-nowrap text-white data-disabled:bg-gray-950 data-disabled:opacity-40 data-hover:bg-gray-800"
                            data-headlessui-state="" href="{{ route('newrestaurant.register') }}">{{ __('Get started') }}</a></div>
                </div>
                <div class="pb-16">
                    <div
                        class="group/row relative isolate pt-[calc(--spacing(2)+1px)] last:pb-[calc(--spacing(2)+1px)]">
                        <div aria-hidden="true" class="absolute inset-y-0 left-1/2 -z-10 w-screen -translate-x-1/2">
                            <div class="absolute inset-x-0 top-0 border-t border-black/5"></div>
                            <div class="absolute inset-x-0 top-2 border-t border-black/5"></div>
                            <div
                                class="absolute inset-x-0 bottom-0 hidden border-b border-black/5 group-last/row:block">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-2 hidden border-b border-black/5 group-last/row:block">
                            </div>
                        </div>
                       
                    </div>
                    <div
                        class="flex justify-between group/row relative isolate pt-[calc(--spacing(2)+1px)] last:pb-[calc(--spacing(2)+1px)]">
                        <div aria-hidden="true" class="absolute inset-y-0 left-1/2 -z-10 w-screen -translate-x-1/2">
                            <div class="absolute inset-x-0 top-0 border-t border-black/5"></div>
                            <div class="absolute inset-x-0 top-2 border-t border-black/5"></div>
                            <div
                                class="absolute inset-x-0 bottom-0 hidden border-b border-black/5 group-last/row:block">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-2 hidden border-b border-black/5 group-last/row:block">
                            </div>
                        </div>
                        <div>
                            <div class="py-3 group/item relative"><svg viewBox="0 0 15 15" aria-hidden="true"
                                    class="hidden group-first/item:block absolute size-[15px] fill-black/10 -top-2 -left-2">
                                    <path d="M8 0H7V7H0V8H7V15H8V8H15V7H8V0Z"></path>
                                </svg><svg viewBox="0 0 15 15" aria-hidden="true"
                                    class="absolute size-[15px] fill-black/10 -top-2 -right-2">
                                    <path d="M8 0H7V7H0V8H7V15H8V8H15V7H8V0Z"></path>
                                </svg><svg viewBox="0 0 15 15" aria-hidden="true"
                                    class="hidden group-first/item:group-last/row:block absolute size-[15px] fill-black/10 -bottom-2 -left-2">
                                    <path d="M8 0H7V7H0V8H7V15H8V8H15V7H8V0Z"></path>
                                </svg><svg viewBox="0 0 15 15" aria-hidden="true"
                                    class="hidden group-last/row:block absolute size-[15px] fill-black/10 -bottom-2 -right-2">
                                    <path d="M8 0H7V7H0V8H7V15H8V8H15V7H8V0Z"></path>
                                </svg>
                                <div class="text-sm/6 text-gray-950">
                                    <p>© <a href="{{ config('app.url') }}" target="_blank">{{  config('app.name') }}</a>
                                        <span class="current-year">{{ date('Y') }}</span>. {{ __('All rights reserved') }}.
                                    </p></div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex items-center gap-8 py-3 group/item relative">
                             <a href="/page/Terms-and-conditions" class="text-gray-950 hover:text-gray-700">{{ __('Terms and conditions') }}</a>
                             <a href="/page/Privacy-Policy" class="text-gray-950 hover:text-gray-700">{{ __('Privacy policy') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</footer>
