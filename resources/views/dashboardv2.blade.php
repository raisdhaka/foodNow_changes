@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="px-6 col-md-8 pt-6" style="border-right: 1px solid rgba(0,0,0,0.08); box-shadow: 10px 0 10px -5px rgba(0,0,0,0.08);">
            <h1 class="display-1">{{ __('Overview') }}</h1>
            <p class="text-muted">{{ __('Hello') }}, {{ auth()->user()->name }}. {{ __('Welcome back') }}.</p>
            <div class="row">
                <div class="col-12">
                    <!-- Statistics Cards -->
                    <div class="row  mb-4">

                        @if(!auth()->user()->hasRole('driver'))
                            @include('layouts.headers.cards.general')
                        @else
                            @include('layouts.headers.cards.driver')
                        @endif
        
                    </div>
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">{{ __('Recent Orders') }}</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">{{ __('See all') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('ID') }}</th>
                                        <th class="table-web" scope="col">{{ __('Created') }}</th>
                                        <th class="table-web" scope="col">{{ __('Method') }}</th>
                                        <th scope="col">{{ __('Last status') }}</th>
                                        <th class="table-web" scope="col">{{ __('Price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($last5Orders as $order)
                                <tr>
                                    <td>
                                        <a class="btn badge badge-success badge-pill" href="{{ route('orders.show',$order->id )}}">#{{ $order->id_formated }}</a>
                                    </td>
                                    <td class="table-web">
                                        {{ $order->created_at->locale(Config::get('app.locale'))->isoFormat('dddd, h:mm A') }}
                                    </td>
                                    <td class="table-web">
                                        <span class="badge badge-primary badge-pill">{{ $order->getExpeditionType() }}</span>
                                    </td>
                                    <td>
                                        @include('orders.partials.laststatus')
                                    </td>
                                    <td class="table-web">
                                        @money( $order->order_price_with_discount, config('settings.cashier_currency'),config('settings.do_convertion'))
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5 col-md-4 pt-2" >
            <div class="">
               
                
                <div class="mt-4">

                    <!-- Search Bar -->
                    <div class="search-container mb-5" style="z-index: 1000;">
                        <div class="search-wrapper" id="search-app">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg search-input" 
                                       v-model="searchQuery"
                                       @input="search"
                                       placeholder="{{ __('Orders, items, expenses...') }}"
                                       style="border-radius: 50px; padding-left: 25px; padding-right: 60px; height: 55px; font-size: 1rem; box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);">
                                <div class="input-group-append">
                                    <button class="btn btn-link search-btn" type="button" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); z-index: 4;">
                                        <i class="fas fa-search text-muted" style="font-size: 1.2rem;"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div v-if="searchResults.length > 0" class="search-results" style="position: absolute; width: 100%; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11); margin-top: 5px; max-height: 400px; overflow-y: auto; z-index: 1000;">
                                <div v-for="result in searchResults" :key="result.id" class="p-3 border-bottom hover:bg-gray-100" style="cursor: pointer;">
                                    <a :href="result.id" class="text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i :class="result.icon" class="text-muted"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">@{{ result.title }}</h6>
                                                <small class="text-muted">@{{ result.subtitle }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <script>
                            new Vue({
                                el: '#search-app',
                                data: {
                                    searchQuery: '',
                                    searchResults: []
                                },
                                methods: {
                                    search() {
                                        if(this.searchQuery.length > 0) {
                                            fetch('/search?q=' + this.searchQuery)
                                                .then(response => response.json())
                                                .then(data => {
                                                    this.searchResults = data.map(item => ({
                                                        id: item.link,
                                                        title: item.name,
                                                        subtitle: item.type,
                                                        icon: item.icon
                                                    }));
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching search results:', error);
                                                    this.searchResults = [];
                                                });
                                        } else {
                                            this.searchResults = [];
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>

                    <div class="earnings-display">
                        <div class="text-center">
                            <p class="text-muted mb-2 h5">{{ __('Total this week') }}</p>
                            <h1 class="display-2 font-weight-bold mb-2">@money(is_numeric($thisWeekOrdersValue['order_price'])?$thisWeekOrdersValue['order_price']:0, config('settings.cashier_currency'), config('settings.do_convertion'))</h1>
                            <p class="text-muted">{{ now()->format('d M Y \a\t H:i A') }}</p>
                        </div>
                        
                        <div class="action-button mt-4 mb-5">
                            <a href="/finances/owner" class="btn btn-lg btn-primary btn-block d-flex align-items-center justify-content-center" style="color: white !important; z-index: 0;">
                                <i class="fas fa-chart-line mr-2"></i>
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </div>

                    <div class="orders-chart mt-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">{{ __('Orders by month') }}</h4>
                            
                        </div>
                        
                        <div id="orders-chart" style="height: 350px;">
                            <canvas id="ordersBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



   
</div>
@endsection

@section('topjs')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endsection
@push('js')




@if(
(auth()->user()->hasRole('admin')&&config('app.isft')) ||
(auth()->user()->hasRole('owner')&&in_array("drivers", config('global.modules',[])))
)

<!-- Live orders -->
<script src="{{ asset('custom') }}/js/liveorders.js"></script>

<!-- Google Map -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&callback=initDriverMap&key=<?php echo config('settings.google_maps_api_key'); ?>">
</script>



<script>
    // Bar chart configuration
    var ctx = document.getElementById('ordersBarChart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(66, 134, 244, 0.9)');
    gradient.addColorStop(1, 'rgba(66, 134, 244, 0.4)');

    //From PHP to JS
    var monthLabels = @json($monthLabels);
    var salesValue = @json($salesValue);
    var totalOrders = [];
    for (const key in salesValue) {
        totalOrders.push(salesValue[key].totalPerMonth);
    }

    // Define an array of colors for each month
    var barColors = [
        'rgba(93, 95, 239, 0.8)',     // Blue/Purple
        'rgba(95, 201, 233, 0.8)',    // Light Blue
        'rgba(255, 99, 132, 0.8)',    // Pink
        'rgba(255, 159, 64, 0.8)',    // Orange
        'rgba(75, 192, 192, 0.8)',    // Teal
        'rgba(153, 102, 255, 0.8)',   // Purple
        'rgba(54, 162, 235, 0.8)',    // Blue
        'rgba(255, 206, 86, 0.8)',    // Yellow
        'rgba(231, 233, 237, 0.8)',   // Grey
        'rgba(156, 204, 101, 0.8)',   // Green
        'rgba(192, 126, 186, 0.8)',   // Purple
        'rgba(255, 138, 101, 0.8)'    // Coral
    ];

    // Define matching border colors (slightly darker versions)
    var borderColors = [
        'rgba(93, 95, 239, 1)',
        'rgba(95, 201, 233, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(231, 233, 237, 1)',
        'rgba(156, 204, 101, 1)',
        'rgba(192, 126, 186, 1)',
        'rgba(255, 138, 101, 1)'
    ];

    var ordersBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Orders',
                data: totalOrders,
                backgroundColor: barColors,
                borderColor: borderColors, 
                borderWidth: 1,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });
</script>
@endif
@endpush
