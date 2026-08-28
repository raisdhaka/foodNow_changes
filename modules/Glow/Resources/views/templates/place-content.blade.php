<!-- section-place-content -->
<section class='section section-place-content bg-gray-100  '>
    <div class='packer w-full'>
        <div class='package '>
            @if ($canDoOrdering)
                <div id="theCartBottomButton" style="background: linear-gradient(87deg, #ffffff 0, #ffffff 100%) !important; z-index: 9999; width: 60px; height:60px; position: fixed; bottom: 15px; right: 15px;" onClick="openNav()" class="close-mobile-menu circle callOutShoppingButtonBottom icon icon-shape bg-gradient-red text-white rounded-circle shadow mb-4" >
                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_atunf5kv.json" background="transparent" speed="0.5" style="width: 60px; height:60px;" loop autoplay></lottie-player>
                </div>
            @endif
           
            <div class='content' style="z-index: 0;">
                
                <!-- tab menu -->
                <div id='place-menu' class='holder-left {{  !$canDoOrdering?"fullHolder":""  }} content-tab expanded'>
                    <div class='content-center'>
                        @if(!$restorant->categories->isEmpty())
                            @foreach ( $restorant->categories as $key => $category)
                            <div class="mb-8">
                                <h1 id='subsection-<?php echo $category->id; ?>' class="text-lg px-6 text-slate-700 font-bold">{{ $category->name }}</h1>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 p-6">
                                    @foreach ($category->aitems as $item)
                                    <a href='javascript:;' onClick="setCurrentItemInGlow({{ $item->id }})"
                                        class="grid relative gap-2 justify-between items-center p-4 bg-white shadow-lg hover:shadow-xl rounded-lg"
                                        style="text-decoration: none; transition: all 0.3s ease-in-out 0s; outline: none; grid-template-rows: 1fr; grid-template-columns: minmax(100px, 1fr) 100px;">
                                        <div class="p-0 m-0 w-full">
                                            <h3 class="text-slate-700 font-bold">{{ $item->name }}</h3>
                                            <p class="mt-1 text-sm text-slate-400">{{ $item->short_description }}</p>
                                            @if ($item->discounted_price>0)
                                                <span style="text-decoration: line-through;" class="mt-1 text-sm text-slate-500 font-bold">@money($item->discounted_price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                            @endif
                                            <span class="mt-1 text-sm text-slate-500 font-bold">@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                            <div class="allergens text-right mt-2">
                                                @foreach ($item->allergens as $allergen)
                                                    <div class='allergen inline-block ml-1' data-toggle="tooltip" data-placement="bottom" title="{{$allergen->title}}">
                                                        <img src="{{$allergen->image_link}}" class="h-6 w-6"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @if (strlen($item->logom)>5)
                                        <div class="w-24 h-24 relative">
                                            <img loading="lazy" src="{{ $item->logom }}"
                                                class="w-full h-full object-cover rounded-lg border border-zinc-100"
                                            />
                                        </div>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($canDoOrdering)
                    <div class='holder-right' style="width:400px">
                        <!-- New cart -->
                        @include('glow::templates.side_cart',['id'=>'cartList','idtotal'=>'totalPrices'])
                        <!-- End New cart -->
                    </div>
                    @endif
                </div>

                <!-- tab info -->
                <div id='place-info' class='holder-left {{  !$canDoOrdering?"fullHolder":""  }} content-tab'>
                    <div class='full-width'>
                        <div class='box-infos bg-white p-3 shadow-lg hover:shadow-xl rounded-lg mr-10'>
                            <div class='head'>
                                <h3><i class="las la-map-marker"></i>{{ __('Address') }}</h3>
                                <div class='info'>
                                    <p><strong>{{ $restorant->address }}</strong></p>
                                    <p>{{ $restorant->phone }}</p>
                                </div>
                            </div>
                            <div class='content'>
                                <div class='schedule-map'>
                                    <div class='schedule'>
                                        <h4 class="mt-4 font-bold">{{ __('Working Hours') }}</h4>
                                        <ol class='items'>
                                            @foreach ($wh as $day=>$hours)
                                                <li>
                                                    @if ($day==$currentDay)
                                                        <div class='day'>{{ __(ucfirst($day))}}
                                                            <span class='tag'>
                                                                {{ __('Today') }}
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class='day'>{{ __(ucfirst($day))}} </div>
                                                    @endif
                                                    @foreach ($hours as $timeRange)
                                                        <div class='hours'>{{ $timeRange->start() }} - {{ $timeRange->end() }} </div>
                                                    @endforeach
                                                    
                                                </li>
                                            @endforeach
                                            
                                        </ol>
                                        
                                    </div>
                                    <div class="map">
                                        <iframe src="https://maps.google.com/maps?q={{ $restorant->lat }},{{ $restorant->lng }}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Photos Gallery -->
                @if(isset($hasPhotos) && $hasPhotos && isset($albums))
                <!-- GLightbox CSS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
                
                <div id='place-photos' class='content-tab w-full'>
                    <div class='full-width'>
                        <div class='box-infos bg-white p-3 shadow-lg hover:shadow-xl rounded-lg'>
                            <div class='head mb-6'>
                                <h3 class="text-xl font-bold text-slate-700">{{ __('Photo Gallery') }}</h3>
                            </div>
                            <div class='content'>
                                @foreach($albums as $album)
                                    @if(count($album->photos) > 0)
                                        <div class="mb-8">
                                            <h4 class="text-lg font-semibold text-slate-600 mb-4">{{ $album->name }}</h4>
                                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" data-gallery="gallery-{{ $album->id }}">
                                                @foreach($album->photos as $photo)
                                                    <div class="relative group">
                                                        <a href="{{ $photo->file_path }}" class="glightbox block" data-gallery="gallery-{{ $album->id }}">
                                                            <img src="{{ $photo->file_path }}" 
                                                                alt="{{ $photo->title }}" 
                                                                class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition-all duration-300 ease-in-out"
                                                            />
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GLightbox JS -->
                <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const lightbox = GLightbox({
                            touchNavigation: true,
                            loop: true,
                            autoplayVideos: true
                        });
                    });
                </script>
                @endif

                <!-- Language selector -->
                <div id='place-languages' class='holder-left {{  !$canDoOrdering?"fullHolder":""  }} content-tab'>
                    <div class='full-width'>
                        <div class='box-infos bg-white p-3 shadow-lg hover:shadow-xl rounded-lg mr-10'>
                            <div class='head'>
                                <h3><i class="las la-map-marker"></i>{{ __('Address') }}</h3>
                                <div class='info'>
                                    <p><strong>{{ $restorant->address }}</strong></p>
                                    <p>{{ $restorant->phone }}</p>
                                </div>
                            </div>
                            <div class='content'>
                                <div class='schedule-map'>
                                    <div class='schedule'>
                                        <h4 class="mt-4 font-bold">{{ __('Working Hours') }}</h4>
                                        <ol class='items'>
                                            @foreach ($wh as $day=>$hours)
                                                <li>
                                                    @if ($day==$currentDay)
                                                        <div class='day'>{{ __(ucfirst($day))}}
                                                            <span class='tag'>
                                                                {{ __('Today') }}
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class='day'>{{ __(ucfirst($day))}} </div>
                                                    @endif
                                                    @foreach ($hours as $timeRange)
                                                        <div class='hours'>{{ $timeRange->start() }} - {{ $timeRange->end() }} </div>
                                                    @endforeach
                                                    
                                                </li>
                                            @endforeach
                                            
                                        </ol>
                                        
                                    </div>
                                    <div class="map">
                                        <iframe src="https://maps.google.com/maps?q={{ $restorant->lat }},{{ $restorant->lng }}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

   
           

</section>