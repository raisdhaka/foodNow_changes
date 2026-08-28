@extends('layouts.app', ['title' => __('Menu Design')])

@section('content')
<div class="container-fluid mt-7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow" style="border-radius: 1rem !important; overflow: hidden;">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Menu Design') }}</h3>
                            <span class="lead text-muted">{{ __('Customize the look and feel of your menu by selecting from our beautifully designed templates.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-image: linear-gradient(310deg, #b1b2ef 0%, #ffffff 100%);">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- First Row of Theme Cards -->
                    <div class="row">
                        <!-- Glow Template Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg {{ $currentTemplate == 'glow' ? 'border border-primary' : '' }}" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="{{ asset('default/themes/glow.png') }}" class="card-img-top" alt="Glow Template" style="height: 200px; object-fit: cover;">
                                    @if($currentTemplate == 'glow' || $currentTemplate == 'defaulttemplate')
                                        <div class="position-absolute" style="top: 10px; right: 10px;">
                                            <span class="badge badge-success p-2">
                                                <i class="fas fa-check"></i> {{ __('Active') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Glow Template') }}</h5>
                                        <span class="badge bg-primary text-white ml-2">{{ __('Modern') }}</span>
                                    </div>
                                    <p>{{ __('A vibrant, eye-catching design with glowing highlights that make your menu items pop. Perfect for bars, nightclubs, and trendy restaurants looking to create a modern digital menu experience.') }}</p>
                                    <div class="mt-auto">
                                        @if($currentTemplate == 'glow' || $currentTemplate == 'defaulttemplate')
                                            <button class="btn btn-block btn-outline-primary text-primary" disabled>
                                                <i class="fas fa-check mr-2"></i>{{ __('Currently Active') }}
                                            </button>
                                        @else
                                            <form action="{{ route('themeswitcher.menu_design.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="template" value="glow">
                                                <button type="submit" class="btn btn-block btn-primary text-white">
                                                    {{ __('Activate Template') }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ $urlToVendor ?? route('vendor', auth()->user()->restorant->subdomain) }}?template=glow" target="_blank" class="btn btn-block btn-outline-info text-info mt-2">
                                            <i class="fas fa-eye mr-2"></i>{{ __('Preview Template') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Elegant Template Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg {{ $currentTemplate == 'elegant-template' ? 'border border-primary' : '' }}" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="{{ asset('default/themes/elegant.png') }}" class="card-img-top" alt="Elegant Template" style="height: 200px; object-fit: cover;">
                                    @if($currentTemplate == 'elegant-template')
                                        <div class="position-absolute" style="top: 10px; right: 10px;">
                                            <span class="badge badge-success p-2">
                                                <i class="fas fa-check"></i> {{ __('Active') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Elegant Template') }}</h5>
                                        <span class="badge bg-success text-white ml-2">{{ __('Stylish') }}</span>
                                    </div>
                                    <p>{{ __('A sophisticated, clean design with subtle animations and refined typography. Ideal for upscale restaurants, fine dining establishments, and venues that want to convey luxury and exclusivity.') }}</p>
                                    <div class="mt-auto">
                                        @if($currentTemplate == 'elegant-template')
                                            <button class="btn btn-block btn-outline-primary text-primary" disabled>
                                                <i class="fas fa-check mr-2"></i>{{ __('Currently Active') }}
                                            </button>
                                        @else
                                            <form action="{{ route('themeswitcher.menu_design.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="template" value="elegant-template">
                                                <button type="submit" class="btn btn-block btn-primary text-white">
                                                    {{ __('Activate Template') }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ $urlToVendor ?? route('vendor', auth()->user()->restorant->subdomain) }}?template=elegant-template" target="_blank" class="btn btn-block btn-outline-info text-info mt-2">
                                            <i class="fas fa-eye mr-2"></i>{{ __('Preview Template') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Clean Template Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg {{ $currentTemplate == 'clean' ? 'border border-primary' : '' }}" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="{{ asset('default/themes/clean.png') }}" class="card-img-top" alt="Clean Template" style="height: 200px; object-fit: cover;">
                                    @if($currentTemplate == 'clean')
                                        <div class="position-absolute" style="top: 10px; right: 10px;">
                                            <span class="badge badge-success p-2">
                                                <i class="fas fa-check"></i> {{ __('Active') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Clean Template') }}</h5>
                                        <span class="badge bg-danger text-white ml-2">{{ __('Minimalist') }}</span>
                                    </div>
                                    <p>{{ __('A minimalist, content-focused design that puts your menu items front and center. Perfect for cafes, casual dining, and establishments that want a straightforward, easy-to-navigate menu that works well on all devices.') }}</p>
                                    <div class="mt-auto">
                                        @if($currentTemplate == 'clean')
                                            <button class="btn btn-block btn-outline-primary text-primary" disabled>
                                                <i class="fas fa-check mr-2"></i>{{ __('Currently Active') }}
                                            </button>
                                        @else
                                            <form action="{{ route('themeswitcher.menu_design.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="template" value="clean">
                                                <button type="submit" class="btn btn-block btn-primary text-white">
                                                    {{ __('Activate Template') }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ $urlToVendor ?? route('vendor', auth()->user()->restorant->subdomain) }}?template=clean" target="_blank" class="btn btn-block btn-outline-info text-info mt-2">
                                            <i class="fas fa-eye mr-2"></i>{{ __('Preview Template') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Second Row of Theme Cards -->
                    <div class="row">
                        <!-- Photo Menu Template Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg {{ $currentTemplate == 'photomenu' ? 'border border-primary' : '' }}" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="{{ asset('default/themes/photomenu.png') }}" onerror="this.src='{{ asset('default/themes/clean.png') }}'" class="card-img-top" alt="Photo Menu Template" style="height: 200px; object-fit: cover;">
                                    @if($currentTemplate == 'photomenu')
                                        <div class="position-absolute" style="top: 10px; right: 10px;">
                                            <span class="badge badge-success p-2">
                                                <i class="fas fa-check"></i> {{ __('Active') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Photo Menu Template') }}</h5>
                                        <span class="badge bg-warning text-white ml-2">{{ __('Visual') }}</span>
                                    </div>
                                    <p>{{ __('An image-first design that showcases your food with large, appetizing photos. Perfect for restaurants with visually appealing dishes that want to create a mouth-watering visual experience for customers browsing their menu.') }}</p>
                                    <div class="mt-auto">
                                        @if($currentTemplate == 'photomenu')
                                            <button class="btn btn-block btn-outline-primary text-primary" disabled>
                                                <i class="fas fa-check mr-2"></i>{{ __('Currently Active') }}
                                            </button>
                                        @else
                                            <form action="{{ route('themeswitcher.menu_design.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="template" value="photomenu">
                                                <button type="submit" class="btn btn-block btn-primary text-white">
                                                    {{ __('Activate Template') }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ $urlToVendor ?? route('vendor', auth()->user()->restorant->subdomain) }}?template=photomenu" target="_blank" class="btn btn-block btn-outline-info text-info mt-2">
                                            <i class="fas fa-eye mr-2"></i>{{ __('Preview Template') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Minimal Template Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg {{ $currentTemplate == 'minimal' ? 'border border-primary' : '' }}" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="{{ asset('default/themes/minimal.png') }}" onerror="this.src='{{ asset('default/themes/clean.png') }}'" class="card-img-top" alt="Minimal Template" style="height: 200px; object-fit: cover;">
                                    @if($currentTemplate == 'minimal')
                                        <div class="position-absolute" style="top: 10px; right: 10px;">
                                            <span class="badge badge-success p-2">
                                                <i class="fas fa-check"></i> {{ __('Active') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Minimal Template') }}</h5>
                                        <span class="badge bg-info text-white ml-2">{{ __('Sleek') }}</span>
                                    </div>
                                    <p>{{ __('A clean, elegant design that puts focus on your menu items with a perfect balance of typography and spacing. Ideal for modern restaurants, cafes, and establishments looking for a sophisticated yet simple digital menu experience.') }}</p>
                                    <div class="mt-auto">
                                        @if($currentTemplate == 'minimal')
                                            <button class="btn btn-block btn-outline-primary text-primary" disabled>
                                                <i class="fas fa-check mr-2"></i>{{ __('Currently Active') }}
                                            </button>
                                        @else
                                            <form action="{{ route('themeswitcher.menu_design.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="template" value="minimal">
                                                <button type="submit" class="btn btn-block btn-primary text-white">
                                                    {{ __('Activate Template') }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ $urlToVendor ?? route('vendor', auth()->user()->restorant->subdomain) }}?template=minimal" target="_blank" class="btn btn-block btn-outline-info text-info mt-2">
                                            <i class="fas fa-eye mr-2"></i>{{ __('Preview Template') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fusion Template Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg {{ $currentTemplate == 'fusion' ? 'border border-primary' : '' }}" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="{{ asset('default/themes/fusion.png') }}" onerror="this.src='{{ asset('default/themes/clean.png') }}'" class="card-img-top" alt="Fusion Template" style="height: 200px; object-fit: cover;">
                                    @if($currentTemplate == 'fusion')
                                        <div class="position-absolute" style="top: 10px; right: 10px;">
                                            <span class="badge badge-success p-2">
                                                <i class="fas fa-check"></i> {{ __('Active') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Fusion Template') }}</h5>
                                        <span class="badge bg-purple text-white ml-2">{{ __('Dynamic') }}</span>
                                    </div>
                                    <p>{{ __('Dynamic layouts with vibrant colors and sleek transitions. Ideal for fusion cuisine, food trucks, and modern eateries that want to showcase their adventurous menus with energy and flair.') }}</p>
                                    <div class="mt-auto">
                                        @if($currentTemplate == 'fusion')
                                            <button class="btn btn-block btn-outline-primary text-primary" disabled>
                                                <i class="fas fa-check mr-2"></i>{{ __('Currently Active') }}
                                            </button>
                                        @else
                                            <form action="{{ route('themeswitcher.menu_design.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="template" value="fusion">
                                                <button type="submit" class="btn btn-block btn-primary text-white">
                                                    {{ __('Activate Template') }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ $urlToVendor ?? route('vendor', auth()->user()->restorant->subdomain) }}?template=fusion" target="_blank" class="btn btn-block btn-outline-info text-info mt-2">
                                            <i class="fas fa-eye mr-2"></i>{{ __('Preview Template') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
</div>
@endsection 