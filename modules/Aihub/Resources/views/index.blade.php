@extends('layouts.app', ['title' => __('AI Hub')])

@section('content')
<div class="container-fluid mt-7 ">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="">
                <div class="card-header" >
                    <h4 class="card-title">AI Hub</h4>
                    <span class="lead text-muted">Explore our powerful AI solutions to enhance your restaurant operations and customer experience.</span>
                    
                </div>  
                <div class="card-body" style="background-image: linear-gradient(310deg, #d8b1ef 0%, #ffffff 100%);">
                   
                    
                    <div class="row">
                        <!-- AI Reservations Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm hover-elevation transition-all rounded-lg" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="https://mobidonia-demo.imgix.net/img/ai_hub/table_reserve.png" class="card-img-top" alt="AI Reservations" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-primary  text-white">Phone Agent</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title d-flex align-items-center">AI Reservations <span class="badge badge-pill badge-danger ml-2">Premium</span></h5>
                                    <p class="card-text flex-grow-1">An intelligent phone agent that handles table reservations for your restaurant. Automatically manages bookings, handles customer preferences, and optimizes your table allocation.</p>
                                    <a href="#" class="d-block text-center">
                                        <span class="text-muted text-sm">Contact us for more info</span>
                                     </a>
                                    <a href="/tablereservations/panel" class="btn btn-outline-primary mt-2">
                                        <i class="fas fa-calendar-alt mr-2"></i> View Reservation
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- AI Suggestions Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm hover-elevation transition-all rounded-lg" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="https://mobidonia-demo.imgix.net/img/ai_hub/order_suggest.png" class="card-img-top" alt="AI Suggestions" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-success text-white">Smart Upsell</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">AI Suggestions</h5>
                                    <p class="card-text flex-grow-1">Boost your revenue with smart item suggestions based on customers' cart contents. Our AI analyzes ordering patterns to recommend perfect complementary items.</p>
                                    <a href="{{ route('admin.owner.apps')}}?search=open_a_i" class="d-block text-center">
                                        <span class="text-muted text-sm">Configure OpenAI</span>
                                     </a>
                                    <a href="/orders" class="btn btn-outline-success mt-2">
                                        <i class="fas fa-shopping-cart mr-2"></i> View Order
                                    </a>
                                    
                                 
                                    
                                </div>
                            </div>
                        </div>
                        
                        <!-- AI Ordering Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm hover-elevation transition-all rounded-lg" style="border-radius: 1rem !important; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="https://mobidonia-demo.imgix.net/img/ai_hub/order_take.png" class="card-img-top" alt="AI Ordering" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-danger  text-white">Phone Agent</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title d-flex align-items-center">AI Ordering <span class="badge badge-pill badge-danger ml-2">Premium</span></h5> 
                                    <p class="card-text flex-grow-1">An advanced phone agent that takes customer orders accurately and efficiently. Handles special requests, dietary restrictions, and processes orders directly into your system.</p>
                                    <a href="#" class="d-block text-center">
                                        <span class="text-muted text-sm">Contact us for more info</span>
                                     </a>
                                    <a href="poscloud/pos" class="btn btn-outline-danger mt-2">
                                        <i class="fas fa-cash-register mr-2"></i> View POS Order
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


@endsection