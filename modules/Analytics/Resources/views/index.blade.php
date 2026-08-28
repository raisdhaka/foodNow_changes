@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-1">{{ __('Analytics') }}</h1>
            <p class="text-muted">{{ __('Analyze your business performance over time') }}</p>
        </div>
    </div>

    <!-- Date Range Selector -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-0">{{ __('Date Range') }}</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('analytics.export', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" class="btn btn-sm btn-primary mr-2">
                                <i class="fa fa-download mr-2"></i>{{ __('Export Data') }}
                            </a>
                            <button id="exportPdfBtn" class="btn btn-sm btn-danger">
                                <i class="fa fa-file-pdf mr-2"></i>{{ __('Export PDF') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="dateRangeForm" method="GET" action="{{ route('analytics.index') }}">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="start_date">{{ __('Start Date') }}</label>
                                    <input type="text" id="start_date" name="start_date" class="form-control datepicker" 
                                        value="{{ $startDate->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="end_date">{{ __('End Date') }}</label>
                                    <input type="text" id="end_date" name="end_date" class="form-control datepicker" 
                                        value="{{ $endDate->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Apply') }}</button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary date-range-btn" data-range="today">{{ __('Today') }}</button>
                                    <button type="button" class="btn btn-outline-primary date-range-btn" data-range="last7">{{ __('Last 7 days') }}</button>
                                    <button type="button" class="btn btn-outline-primary date-range-btn" data-range="last30">{{ __('Last 30 days') }}</button>
                                    <button type="button" class="btn btn-outline-primary date-range-btn" data-range="month">{{ __('Month to date') }}</button>
                                    <button type="button" class="btn btn-outline-primary date-range-btn" data-range="quarter">{{ __('Quarter to date') }}</button>
                                    <button type="button" class="btn btn-outline-primary date-range-btn" data-range="year">{{ __('Year to date') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row">
        <!-- Orders KPI -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ __('New orders') }}</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $totalOrders }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-nowrap">{{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Revenue KPI -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Revenue') }}</h5>
                            <span class="h2 font-weight-bold mb-0">@money($totalOrdersAmount, config('settings.cashier_currency'), config('settings.do_convertion'))</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-nowrap">{{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Average Order Value KPI -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Avg Order Value') }}</h5>
                            <span class="h2 font-weight-bold mb-0">@money($avgOrderValue, config('settings.cashier_currency'), config('settings.do_convertion'))</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-nowrap">{{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Expenses KPI -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Expenses') }}</h5>
                            <span class="h2 font-weight-bold mb-0">@money($totalExpenses, config('settings.cashier_currency'), config('settings.do_convertion'))</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fas fa-money-bill"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-nowrap">{{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders & Revenue Chart (Full Width) -->
    <div class="row mt-4">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Performance') }}</h6>
                            <h2 class="mb-0">{{ __('Orders & Revenue') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="ordersRevenueChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Comparison Chart -->
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Monthly Comparison') }}</h6>
                            <h2 class="mb-0">{{ __('Revenue vs Expenses') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="monthlyComparisonChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Charts Row 1 -->
    <div class="row mt-4">
        <!-- Sales by Category Chart -->
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Sales Analysis') }}</h6>
                            <h2 class="mb-0">{{ __('Sales by Category') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="salesByCategoryChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popular Menu Items Chart -->
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Product Analysis') }}</h6>
                            <h2 class="mb-0">{{ __('Popular Menu Items') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="popularMenuItemsChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders by Expedition Type Chart -->
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Order Distribution') }}</h6>
                            <h2 class="mb-0">{{ __('Orders by Expedition Type') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" style="height: 350px;">
                        <canvas id="ordersByExpeditionTypeChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expenses by Vendor Chart -->
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Expense Distribution') }}</h6>
                            <h2 class="mb-0">{{ __('Expenses by Vendor') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" style="height: 350px;">
                        <canvas id="expensesByVendorChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Reservations Chart -->
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Reservations Analysis') }}</h6>
                            <h2 class="mb-0">{{ __('Table Reservations') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="tableReservationsChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Use Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<!-- Use flatpickr from CDN -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">

<!-- Print styles -->
<style media="print">
    @page {
        size: A4 landscape;
        margin: 10mm;
    }
    
    body {
        print-color-adjust: exact !important;
        -webkit-print-color-adjust: exact !important;
    }
    
    .container-fluid {
        width: 100% !important;
        padding: 0 !important;
    }
    
    .card {
        break-inside: avoid;
        page-break-inside: avoid;
        margin-bottom: 20px !important;
        border: 1px solid #e6e6e6 !important;
        box-shadow: none !important;
    }
    
    .no-print, .no-print * {
        display: none !important;
    }
    
    .card-header {
        background-color: #f8f9fe !important;
        border-bottom: 1px solid #e6e6e6 !important;
    }
    
    .chart {
        min-height: 300px !important;
        height: auto !important;
    }
    
    h1.display-1 {
        font-size: 24pt !important;
    }
    
    .card-stats .card-body {
        padding: 1rem !important;
    }
    
    .icon-shape {
        print-color-adjust: exact !important;
        -webkit-print-color-adjust: exact !important;
    }
</style>

<script>
    // Initialize date pickers
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        allowInput: true
    });

    // Date range quick buttons
    document.querySelectorAll('.date-range-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const range = this.getAttribute('data-range');
            const today = new Date();
            let startDate, endDate;

            switch(range) {
                case 'today':
                    startDate = today;
                    endDate = today;
                    break;
                case 'last7':
                    startDate = new Date();
                    startDate.setDate(today.getDate() - 6);
                    endDate = today;
                    break;
                case 'last30':
                    startDate = new Date();
                    startDate.setDate(today.getDate() - 29);
                    endDate = today;
                    break;
                case 'month':
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    endDate = today;
                    break;
                case 'quarter':
                    const quarter = Math.floor(today.getMonth() / 3);
                    startDate = new Date(today.getFullYear(), quarter * 3, 1);
                    endDate = today;
                    break;
                case 'year':
                    startDate = new Date(today.getFullYear(), 0, 1);
                    endDate = today;
                    break;
            }

            // Format dates as YYYY-MM-DD
            document.getElementById('start_date').value = formatDate(startDate);
            document.getElementById('end_date').value = formatDate(endDate);
            
            // Automatically submit the form
            document.getElementById('dateRangeForm').submit();
        });
    });

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Chart data
    const labels = @json($dateLabels);
    const ordersData = @json(array_values($ordersData['daily_counts']));
    const revenueData = @json(array_values($ordersData['daily_amounts']));
    const expensesData = @json(array_values($expensesData['daily_amounts']));
    const reservationsData = @json(array_values($reservationsData['daily_counts']));
    
    // New charts data
    const salesByCategoryLabels = @json($salesByCategoryData['categories']);
    const salesByCategoryData = @json($salesByCategoryData['sales']);
    
    const popularMenuItemsLabels = @json($popularMenuItemsData['items']);
    const popularMenuItemsData = @json($popularMenuItemsData['quantities']);
    const popularMenuItemsSales = @json($popularMenuItemsData['sales']);
    
    const ordersByExpeditionTypeLabels = @json($ordersByExpeditionTypeData['labels']);
    const ordersByExpeditionTypeData = @json($ordersByExpeditionTypeData['counts']);
    
    const expensesByVendorLabels = @json($expensesByVendorData['labels']);
    const expensesByVendorData = @json($expensesByVendorData['amounts']);
    
    // Orders & Revenue Chart
    const ordersRevenueChartElement = document.getElementById('ordersRevenueChart');
    if (ordersRevenueChartElement) {
        const ordersRevenueChart = new Chart(ordersRevenueChartElement, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: '{{ __("Orders") }}',
                        data: ordersData,
                        borderColor: '#5e72e4',
                        backgroundColor: 'rgba(94, 114, 228, 0.1)',
                        borderWidth: 2,
                        pointRadius: 2,
                        fill: true,
                        yAxisID: 'y-left',
                    },
                    {
                        label: '{{ __("Revenue") }}',
                        data: revenueData,
                        borderColor: '#2dce89',
                        backgroundColor: 'rgba(45, 206, 137, 0.1)',
                        borderWidth: 2,
                        pointRadius: 2,
                        fill: true,
                        yAxisID: 'y-right',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    'y-left': {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: '{{ __("Orders") }}'
                        },
                        beginAtZero: true
                    },
                    'y-right': {
                        type: 'linear',
                        position: 'right',
                        title: {
                            display: true,
                            text: '{{ __("Revenue") }}'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Monthly Comparison Chart
    const monthlyComparisonChartElement = document.getElementById('monthlyComparisonChart');
    if (monthlyComparisonChartElement) {
        // Group data by month
        const monthlyRevenue = {};
        const monthlyExpenses = {};
        
        // Process revenue data
        revenueData.forEach((value, index) => {
            const date = labels[index];
            const month = date.split(' ')[0]; // Get month abbreviation
            if (!monthlyRevenue[month]) {
                monthlyRevenue[month] = 0;
            }
            monthlyRevenue[month] += value;
        });
        
        // Process expenses data
        expensesData.forEach((value, index) => {
            const date = labels[index];
            const month = date.split(' ')[0]; // Get month abbreviation
            if (!monthlyExpenses[month]) {
                monthlyExpenses[month] = 0;
            }
            monthlyExpenses[month] += value;
        });
        
        // Get unique months from both datasets
        const months = [...new Set([...Object.keys(monthlyRevenue), ...Object.keys(monthlyExpenses)])];
        
        // Create datasets
        const revenueByMonth = months.map(month => monthlyRevenue[month] || 0);
        const expensesByMonth = months.map(month => monthlyExpenses[month] || 0);
        
        const monthlyComparisonChart = new Chart(monthlyComparisonChartElement, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: '{{ __("Revenue") }}',
                        data: revenueByMonth,
                        backgroundColor: 'rgba(45, 206, 137, 0.7)',
                        borderColor: '#2dce89',
                        borderWidth: 1,
                        borderRadius: 5,
                    },
                    {
                        label: '{{ __("Expenses") }}',
                        data: expensesByMonth,
                        backgroundColor: 'rgba(245, 54, 92, 0.7)',
                        borderColor: '#f5365c',
                        borderWidth: 1,
                        borderRadius: 5,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: '{{ config("settings.cashier_currency") }}'
                        }
                    }
                }
            }
        });
    }
    
    // Sales by Category Chart
    const salesByCategoryChartElement = document.getElementById('salesByCategoryChart');
    if (salesByCategoryChartElement) {
        // Generate colors for bars
        const categoryColors = salesByCategoryLabels.map((_, index) => {
            const colorIndex = index % 8;
            const colors = [
                'rgba(66, 134, 244, 0.8)',
                'rgba(45, 206, 137, 0.8)',
                'rgba(251, 99, 64, 0.8)',
                'rgba(245, 54, 92, 0.8)',
                'rgba(94, 114, 228, 0.8)',
                'rgba(168, 85, 247, 0.8)',
                'rgba(234, 179, 8, 0.8)',
                'rgba(20, 184, 166, 0.8)'
            ];
            return colors[colorIndex];
        });
        
        const salesByCategoryChart = new Chart(salesByCategoryChartElement, {
            type: 'bar',
            data: {
                labels: salesByCategoryLabels,
                datasets: [
                    {
                        label: '{{ __("Sales Amount") }}',
                        data: salesByCategoryData,
                        backgroundColor: categoryColors,
                        borderWidth: 1,
                        borderRadius: 5,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: '{{ config("settings.cashier_currency") }}'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
    
    // Popular Menu Items Chart
    const popularMenuItemsChartElement = document.getElementById('popularMenuItemsChart');
    if (popularMenuItemsChartElement) {
        // Generate colors for bars
        const itemColors = popularMenuItemsLabels.map((_, index) => {
            const colorIndex = index % 8;
            const colors = [
                'rgba(94, 114, 228, 0.8)',
                'rgba(45, 206, 137, 0.8)',
                'rgba(251, 99, 64, 0.8)',
                'rgba(245, 54, 92, 0.8)',
                'rgba(66, 134, 244, 0.8)',
                'rgba(168, 85, 247, 0.8)',
                'rgba(234, 179, 8, 0.8)',
                'rgba(20, 184, 166, 0.8)'
            ];
            return colors[colorIndex];
        });
        
        const popularMenuItemsChart = new Chart(popularMenuItemsChartElement, {
            type: 'bar',
            data: {
                labels: popularMenuItemsLabels,
                datasets: [
                    {
                        label: '{{ __("Quantity Sold") }}',
                        data: popularMenuItemsData,
                        backgroundColor: itemColors,
                        borderWidth: 1,
                        borderRadius: 5,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: '{{ __("Units") }}'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
    
    // Orders by Expedition Type Chart
    const ordersByExpeditionTypeChartElement = document.getElementById('ordersByExpeditionTypeChart');
    if (ordersByExpeditionTypeChartElement) {
        // Colors for pie chart
        const expeditionColors = [
            'rgba(45, 206, 137, 0.8)',  // Delivery
            'rgba(66, 134, 244, 0.8)',  // Pickup
            'rgba(251, 99, 64, 0.8)',   // Dine in
            'rgba(245, 54, 92, 0.8)'    // Unknown
        ];
        
        const ordersByExpeditionTypeChart = new Chart(ordersByExpeditionTypeChartElement, {
            type: 'pie',
            data: {
                labels: ordersByExpeditionTypeLabels,
                datasets: [
                    {
                        data: ordersByExpeditionTypeData,
                        backgroundColor: expeditionColors,
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 12
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((acc, curr) => acc + curr, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Expenses by Vendor Chart
    const expensesByVendorChartElement = document.getElementById('expensesByVendorChart');
    if (expensesByVendorChartElement) {
        // Colors for pie chart
        const vendorColors = [
            'rgba(94, 114, 228, 0.8)',
            'rgba(245, 54, 92, 0.8)',
            'rgba(251, 99, 64, 0.8)',
            'rgba(45, 206, 137, 0.8)',
            'rgba(66, 134, 244, 0.8)',
            'rgba(168, 85, 247, 0.8)',
            'rgba(234, 179, 8, 0.8)',
            'rgba(20, 184, 166, 0.8)'
        ];
        
        const expensesByVendorChart = new Chart(expensesByVendorChartElement, {
            type: 'pie',
            data: {
                labels: expensesByVendorLabels,
                datasets: [
                    {
                        data: expensesByVendorData,
                        backgroundColor: vendorColors,
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 12
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((acc, curr) => acc + curr, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value.toFixed(2)} {{ config('settings.cashier_currency') }} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Table Reservations Chart
    const tableReservationsChartElement = document.getElementById('tableReservationsChart');
    if (tableReservationsChartElement) {
        const tableReservationsChart = new Chart(tableReservationsChartElement, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: '{{ __("Table Reservations") }}',
                        data: reservationsData,
                        borderColor: '#fb6340',
                        backgroundColor: 'rgba(251, 99, 64, 0.1)',
                        borderWidth: 3,
                        pointRadius: 3,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: '{{ __("Date") }}'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: '{{ __("Number of Reservations") }}'
                        },
                        ticks: {
                            precision: 0, // Only show integer values
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                return labels[tooltipItems[0].dataIndex];
                            },
                            label: function(context) {
                                const value = context.raw || 0;
                                return `${value} ${value === 1 ? '{{ __("reservation") }}' : '{{ __("reservations") }}'}`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Export to PDF functionality
    document.getElementById('exportPdfBtn').addEventListener('click', function() {
        // Prepare page for printing
        const printTitle = document.createElement('div');
        printTitle.classList.add('print-only');
        printTitle.innerHTML = '<h1 style="text-align: center; margin-bottom: 20px;">Analytics Report: ' + 
                              '{{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}' + '</h1>';
        
        document.body.insertBefore(printTitle, document.body.firstChild);
        
        // Add no-print class to elements we don't want to print
        document.querySelector('.row.mb-4').classList.add('no-print'); // Hide entire date range card
        
        // Wait for a moment to ensure charts are properly rendered
        setTimeout(() => {
            window.print();
            
            // Remove print-only elements and classes after printing
            document.body.removeChild(printTitle);
            document.querySelector('.row.mb-4').classList.remove('no-print');
        }, 300);
    });
</script>
@endsection
