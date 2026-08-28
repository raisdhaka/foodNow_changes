@extends('layouts.app', ['title' => __('Mobile Apps')])

@section('content')
<div class="container-fluid mt-7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow" style="border-radius: 1rem !important; overflow: hidden;">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{ __('Mobile Apps') }}</h3>
                            <span class="lead text-muted">Explore our powerful mobile apps to enhance your restaurant operations and customer experience.</span>
                    
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background-image: linear-gradient(310deg, #b1b2ef 0%, #ffffff 100%);">
                    <div class="row">
                        <!-- Vendor App Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="https://mobidonia-demo.imgix.net/img/mobile_apps/Vendor_app.jpg" class="card-img-top" alt="Vendor App" style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Vendor App') }}</h5>
                                        <span class="badge bg-primary text-white ml-2">{{ __('Manage') }}</span>
                                    </div>
                                    <p>{{ __('Streamline your restaurant operations with our powerful vendor app. Manage orders in real-time, track sales, and receive instant notifications - all from your mobile device. Perfect for staying connected to your business anywhere, anytime.') }}</p>
                                    <div class="app-buttons mt-auto d-flex">
                                        @if(!empty($vendorAppAndroidLink))
                                            <a href="{{ $vendorAppAndroidLink }}" target="_blank" class="btn flex-grow-1 mr-2 text-white text-center py-2" style="background-color: #6366F1; border-radius: 0.5rem;">
                                                <i class="fab fa-android mr-2"></i>{{ __('Android App') }}
                                            </a>
                                        @endif
                                        @if(!empty($vendorAppIosLink))
                                            <a href="{{ $vendorAppIosLink }}" target="_blank" class="btn flex-grow-1 text-white text-center py-2" style="background-color: #06B6D4; border-radius: 0.5rem;">
                                                <i class="fab fa-apple mr-2"></i>{{ __('iOS App') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Driver App Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="https://mobidonia-demo.imgix.net/img/mobile_apps/Driver_app.jpg" class="card-img-top" alt="Driver App" style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Driver App') }}</h5>
                                        <span class="badge bg-success text-white ml-2">{{ __('Deliver') }}</span>
                                    </div>
                                    <p>{{ __('Empower your delivery team with our intuitive driver app. Navigate efficiently with built-in maps, receive order details instantly, communicate with customers, and manage delivery statuses with ease. Designed to maximize delivery speed and provide a seamless experience for both drivers and customers.') }}</p>
                                    <div class="app-buttons mt-auto d-flex">
                                        @if(!empty($driverAppAndroidLink))
                                            <a href="{{ $driverAppAndroidLink }}" target="_blank" class="btn flex-grow-1 mr-2 text-white text-center py-2" style="background-color: #6366F1; border-radius: 0.5rem;">
                                                <i class="fab fa-android mr-2"></i>{{ __('Android App') }}
                                            </a>
                                        @endif
                                        @if(!empty($driverAppIosLink))
                                            <a href="{{ $driverAppIosLink }}" target="_blank" class="btn flex-grow-1 text-white text-center py-2" style="background-color: #06B6D4; border-radius: 0.5rem;">
                                                <i class="fab fa-apple mr-2"></i>{{ __('iOS App') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Client App Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow h-100 hover-elevation transition-all rounded-lg" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="https://mobidonia-demo.imgix.net/img/mobile_apps/Client_app.jpg" class="card-img-top" alt="Client App" style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 mr-2">{{ __('Client App') }}</h5>
                                        <span class="badge bg-danger text-white ml-2">{{ __('Grow') }}</span>
                                    </div>
                                    <p>{{ __('Enhance your customers\' ordering experience with our feature-rich client app. Browse menus with stunning food images, customize orders with special requests, track deliveries in real-time, and enjoy secure payment options. Share this app with your customers for a convenient mobile ordering experience. Contact us about creating your own branded version for maximum brand recognition.') }}</p>
                                    <div class="app-buttons mt-auto d-flex">
                                        @if(!empty($clientAppAndroidLink))
                                            <a href="{{ $clientAppAndroidLink }}" target="_blank" class="btn flex-grow-1 mr-2 text-white text-center py-2" style="background-color: #6366F1; border-radius: 0.5rem;">
                                                <i class="fab fa-android mr-2"></i>{{ __('Android App') }}
                                            </a>
                                        @endif
                                        @if(!empty($clientAppIosLink))
                                            <a href="{{ $clientAppIosLink }}" target="_blank" class="btn flex-grow-1 text-white text-center py-2" style="background-color: #06B6D4; border-radius: 0.5rem;">
                                                <i class="fab fa-apple mr-2"></i>{{ __('iOS App') }}
                                            </a>
                                        @endif
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
