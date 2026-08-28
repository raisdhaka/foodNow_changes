<div class="relative z-50 w-full h-24">
                <div class="container flex items-center justify-center h-full max-w-6xl px-8 mx-auto sm:justify-between xl:px-0">
        
                    <a href="/" class="relative flex items-center inline-block h-auto h-full font-black leading-none">
                        <img class="navbar-brand-dark" src="{{ config('global.site_logo') }}" height="35" style="width: 100px;" alt="Logo">
                        <img class="navbar-brand-light" src="{{ config('global.site_logo_dark') }}" height="35" style="width: 100px;" alt="Logo">
                    </a>
        
                    <nav class="absolute top-0 left-0 z-50 flex-col items-center justify-between hidden w-full h-64 pt-5 mt-24 text-sm text-zinc-800 bg-white border-t border-zinc-200 shadow-xl md:shadow-none md:flex md:w-auto md:flex-row md:h-24 lg:text-base md:bg-transparent md:mt-0 md:border-none md:py-0 md:relative" :class="{'flex fixed': showMenu, 'hidden': !showMenu }">
                        <a href="/#features" class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-gray-900" data-primary="gray-900">{{ __('Features') }}</a>
                        <a href="/#pricing" class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-gray-900" data-primary="gray-900">{{ __('Pricing') }}</a>
                        <a href="/#testimonials" class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-gray-900" data-primary="gray-900">{{ __('Testimonials') }}</a>
                        <a href="/blog" class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-gray-900" data-primary="gray-900">{{ __('Blog') }}</a>
                        <a href="/#faq" class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-gray-900" data-primary="gray-900">{{ __('FAQ') }}</a>

                        @if(isset($availableLanguages) && count($availableLanguages) > 1)
                        <div class="language-dropdown">
                            <button type="button" class="flex items-center font-bold py-2 px-3">
                                @foreach ($availableLanguages as $short => $lang)
                                    @if(strtolower($short) == strtolower($locale ?? app()->getLocale())) 
                                        <span>{{ __($lang) }}</span> 
                                    @endif
                                @endforeach
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="language-dropdown-content">
                                @foreach ($availableLanguages as $short => $lang)
                                <a href="/{{ strtolower($short) }}">{{ __($lang) }}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty(config('global.facebook')))
                        <a href="{{ config('global.facebook') }}" target="_blank" class="mr-3 font-bold text-gray-900 hover:text-gray-700 flex items-center">
                            <i class="fab fa-facebook-square mr-1"></i>
                        </a>
                        @endif
                        
                        @if(!empty(config('global.instagram')))
                        <a href="{{ config('global.instagram') }}" target="_blank" class="mr-3 font-bold text-gray-900 hover:text-gray-700 flex items-center">
                            <i class="fab fa-instagram mr-1"></i>
                        </a>
                        @endif
                        
                        <div class="flex flex-col block w-full font-medium border-t border-zinc-200 md:hidden">
                            @auth
                            <a href="/login" class="relative inline-block w-full px-5 py-3 text-sm leading-none text-center text-white bg-gray-900 fold-bold" data-primary="gray-900">{{ __('Dashboard') }}</a>
                            @else
                            <a href="/login" class="w-full py-2 font-bold text-center text-gray-900" data-primary="gray-900">{{ __('Login') }}</a>
                            @guest
                            <a href="{{ route('newrestaurant.register') }}" class="relative inline-block w-full px-5 py-3 text-sm leading-none text-center text-white bg-gray-900 fold-bold" data-primary="gray-900">{{ __('Register') }}</a>
                            @endguest
                            @endauth
                        </div>
                    </nav>
        
                    <div class="absolute left-0 flex-col items-center justify-center hidden w-full pb-8 mt-48 border-b border-zinc-200 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                        @auth
                        <a href="/login" class="relative z-40 inline-block w-auto h-full px-5 py-3 text-sm font-bold leading-none text-white transition-all transition duration-100 duration-300 bg-gray-900 rounded shadow-md fold-bold sm:w-full lg:shadow-none hover:shadow-xl" data-primary="gray-900" data-rounded="rounded">{{ __('Dashboard') }}</a>
                        @else
                        <a href="/login" class="relative z-40 px-3 py-2 mr-0 text-sm font-bold text-gray-900 md:px-5 sm:mr-3 md:mt-0" data-primary="gray-900">{{ __('Login') }}</a>
                        @guest
                        <a href="{{ route('newrestaurant.register') }}" class="relative z-40 inline-block w-auto h-full px-5 py-3 text-sm font-bold leading-none text-white transition-all transition duration-100 duration-300 bg-gray-900 rounded shadow-md fold-bold sm:w-full lg:shadow-none hover:shadow-xl" data-primary="gray-900" data-rounded="rounded">{{ __('Register') }}</a>
                        @endguest
                        @endauth
                    </div>
        
                    <div @click="showMenu = !showMenu" class="absolute top-0 right-0 z-50 block w-6 mt-8 mr-10 cursor-pointer select-none md:hidden sm:mt-10">
                        <span class="block w-full h-1 mt-2 duration-200 transform bg-zinc-800 rounded-full sm:mt-1"></span>
                        <span class="block w-full h-1 mt-1 duration-200 transform bg-zinc-800 rounded-full"></span>
                    </div>
        
                </div>
            </div>