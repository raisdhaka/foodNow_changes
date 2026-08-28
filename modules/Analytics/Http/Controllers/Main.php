<?php

namespace Modules\Analytics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Order;
use App\Items;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Modules\Expenses\Models\Expenses;
use Modules\Tablereservations\Models\Reservation;

class Main extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        // Get current restaurant
        $restaurant = $this->getRestaurant();
        if (!$restaurant) {
            abort(403, 'No restaurant found for this user.');
        }
        
        // Default date range (last 30 days)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        
        // Convert to Carbon instances for easier manipulation
        $startDateCarbon = Carbon::parse($startDate);
        $endDateCarbon = Carbon::parse($endDate);
        
        // Get analytics data
        $ordersData = $this->getOrdersAnalytics($startDateCarbon, $endDateCarbon, $restaurant);
        $expensesData = $this->getExpensesAnalytics($startDateCarbon, $endDateCarbon, $restaurant);
        $reservationsData = $this->getReservationsAnalytics($startDateCarbon, $endDateCarbon, $restaurant);
        
        // Get additional charts data
        $salesByCategoryData = $this->getSalesByCategory($startDateCarbon, $endDateCarbon, $restaurant);
        $popularMenuItemsData = $this->getPopularMenuItems($startDateCarbon, $endDateCarbon, $restaurant);
        $ordersByExpeditionTypeData = $this->getOrdersByExpeditionType($startDateCarbon, $endDateCarbon, $restaurant);
        $expensesByVendorData = $this->getExpensesByVendor($startDateCarbon, $endDateCarbon, $restaurant);
        
        // Calculate summary data
        $totalOrders = $ordersData['total_count'];
        $totalOrdersAmount = $ordersData['total_amount'];
        $totalExpenses = $expensesData['total_amount'];
        $totalReservations = $reservationsData['total_count'];
        $avgOrderValue = $totalOrders > 0 ? $totalOrdersAmount / $totalOrders : 0;
        
        // Format data for charts
        $dateLabels = $this->generateDateLabels($startDateCarbon, $endDateCarbon);
        
        return view('analytics::index', [
            'startDate' => $startDateCarbon,
            'endDate' => $endDateCarbon,
            'totalOrders' => $totalOrders,
            'totalOrdersAmount' => $totalOrdersAmount,
            'totalExpenses' => $totalExpenses,
            'totalReservations' => $totalReservations,
            'avgOrderValue' => $avgOrderValue,
            'ordersData' => $ordersData,
            'expensesData' => $expensesData,
            'reservationsData' => $reservationsData,
            'dateLabels' => $dateLabels,
            'salesByCategoryData' => $salesByCategoryData,
            'popularMenuItemsData' => $popularMenuItemsData,
            'ordersByExpeditionTypeData' => $ordersByExpeditionTypeData,
            'expensesByVendorData' => $expensesByVendorData,
        ]);
    }

    /**
     * Get analytics data for orders
     */
    private function getOrdersAnalytics($startDate, $endDate, $restaurant)
    {
        // Query orders within date range for the specific restaurant
        $orders = Order::where('restorant_id', $restaurant->id)
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->get();
        
        // Initialize return data
        $data = [
            'total_count' => $orders->count(),
            'total_amount' => $orders->sum('order_price_with_discount'),
            'daily_counts' => [],
            'daily_amounts' => [],
        ];
        
        // Group by date
        $ordersByDate = $orders->groupBy(function($order) {
            return Carbon::parse($order->created_at)->format('Y-m-d');
        });
        
        // Generate data for each day in range
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');
            $data['daily_counts'][$dateKey] = isset($ordersByDate[$dateKey]) ? $ordersByDate[$dateKey]->count() : 0;
            $data['daily_amounts'][$dateKey] = isset($ordersByDate[$dateKey]) ? $ordersByDate[$dateKey]->sum('order_price_with_discount') : 0;
        }
        
        return $data;
    }

    /**
     * Get data for Sales by Category chart
     */
    private function getSalesByCategory($startDate, $endDate, $restaurant)
    {
        // Query to get sales by category within date range for the specific restaurant
        $categorySales = DB::table('orders')
            ->join('order_has_items', 'orders.id', '=', 'order_has_items.order_id')
            ->join('items', 'order_has_items.item_id', '=', 'items.id')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->where('orders.restorant_id', $restaurant->id)
            ->whereBetween('orders.created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->whereNull('orders.deleted_at')
            ->select(
                'categories.name as category',
                DB::raw('SUM(order_has_items.variant_price * order_has_items.qty) as sales_amount'),
                DB::raw('COUNT(DISTINCT orders.id) as order_count')
            )
            ->groupBy('categories.name')
            ->orderBy('sales_amount', 'desc')
            ->get();
            
        return [
            'categories' => $categorySales->pluck('category')->toArray(),
            'sales' => $categorySales->pluck('sales_amount')->toArray(),
            'orders' => $categorySales->pluck('order_count')->toArray(),
        ];
    }

    /**
     * Get data for Popular Menu Items chart
     */
    private function getPopularMenuItems($startDate, $endDate, $restaurant)
    {
        // Query to get top 10 popular menu items within date range for the specific restaurant
        $popularItems = DB::table('orders')
            ->join('order_has_items', 'orders.id', '=', 'order_has_items.order_id')
            ->join('items', 'order_has_items.item_id', '=', 'items.id')
            ->where('orders.restorant_id', $restaurant->id)
            ->whereBetween('orders.created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->whereNull('orders.deleted_at')
            ->select(
                'items.name as item_name',
                DB::raw('SUM(order_has_items.qty) as quantity_sold'),
                DB::raw('SUM(order_has_items.variant_price * order_has_items.qty) as sales_amount')
            )
            ->groupBy('items.name')
            ->orderBy('quantity_sold', 'desc')
            ->limit(10)
            ->get();
            
        return [
            'items' => $popularItems->pluck('item_name')->toArray(),
            'quantities' => $popularItems->pluck('quantity_sold')->toArray(),
            'sales' => $popularItems->pluck('sales_amount')->toArray(),
        ];
    }

    /**
     * Get data for Orders by Expedition Type chart
     */
    private function getOrdersByExpeditionType($startDate, $endDate, $restaurant)
    {
        // Query to get orders by expedition type within date range for the specific restaurant
        $expeditionTypes = DB::table('orders')
            ->where('restorant_id', $restaurant->id)
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->whereNull('deleted_at')
            ->select(
                'delivery_method',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('delivery_method')
            ->get();
            
        // Convert delivery_method codes to readable labels
        $expeditionLabels = [];
        $expeditionCounts = [];
        
        foreach ($expeditionTypes as $type) {
            $label = 'Unknown';
            
            switch ($type->delivery_method) {
                case 1:
                    $label = 'Delivery';
                    break;
                case 2:
                    $label = 'Pickup';
                    break;
                case 3:
                    $label = 'Dine in';
                    break;
            }
            
            $expeditionLabels[] = $label;
            $expeditionCounts[] = $type->count;
        }
            
        return [
            'labels' => $expeditionLabels,
            'counts' => $expeditionCounts,
        ];
    }

    /**
     * Get data for Expenses by Vendor chart
     */
    private function getExpensesByVendor($startDate, $endDate, $restaurant)
    {
        // Check if Expenses module exists
        if (!class_exists(Expenses::class)) {
            return [
                'labels' => [],
                'amounts' => [],
            ];
        }
        
        // Query to get expenses by vendor within date range for the specific restaurant
        $expensesByVendor = DB::table('expenses')
            ->leftJoin('expenses_vendor', 'expenses.expenses_vendor_id', '=', 'expenses_vendor.id')
            ->where('expenses.restaurant_id', $restaurant->id)
            ->whereBetween('expenses.created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->select(
                'expenses_vendor.name as vendor_name',
                'expenses.expenses_vendor_id',
                DB::raw('SUM(expenses.amount) as total_amount')
            )
            ->groupBy('expenses.expenses_vendor_id', 'expenses_vendor.name')
            ->orderBy('total_amount', 'desc')
            ->get();
            
        // Format data for chart
        $vendorLabels = [];
        $vendorAmounts = [];
        
        foreach ($expensesByVendor as $expense) {
            // Use "Other" if vendor_name is null or empty
            $label = $expense->vendor_name ? $expense->vendor_name : 'Other';
            $vendorLabels[] = $label;
            $vendorAmounts[] = $expense->total_amount;
        }
            
        return [
            'labels' => $vendorLabels,
            'amounts' => $vendorAmounts,
        ];
    }

    /**
     * Get analytics data for expenses
     */
    private function getExpensesAnalytics($startDate, $endDate, $restaurant)
    {
        // Check if Expenses module exists
        if (!class_exists(Expenses::class)) {
            return [
                'total_count' => 0,
                'total_amount' => 0,
                'daily_counts' => [],
                'daily_amounts' => [],
            ];
        }
        
        // Query expenses within date range for the specific restaurant
        $expenses = Expenses::where('restaurant_id', $restaurant->id)
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->get();
        
        // Initialize return data
        $data = [
            'total_count' => $expenses->count(),
            'total_amount' => $expenses->sum('amount'),
            'daily_counts' => [],
            'daily_amounts' => [],
        ];
        
        // Group by date
        $expensesByDate = $expenses->groupBy(function($expense) {
            return Carbon::parse($expense->created_at)->format('Y-m-d');
        });
        
        // Generate data for each day in range
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');
            $data['daily_counts'][$dateKey] = isset($expensesByDate[$dateKey]) ? $expensesByDate[$dateKey]->count() : 0;
            $data['daily_amounts'][$dateKey] = isset($expensesByDate[$dateKey]) ? $expensesByDate[$dateKey]->sum('amount') : 0;
        }
        
        return $data;
    }

    /**
     * Get analytics data for reservations
     */
    private function getReservationsAnalytics($startDate, $endDate, $restaurant)
    {
        // Check if Reservation module exists
        if (!class_exists(Reservation::class)) {
            return [
                'total_count' => 0,
                'daily_counts' => [],
            ];
        }
        
        // Query reservations within date range for the specific restaurant
        $reservations = Reservation::where('company_id', $restaurant->id)
            ->whereBetween('reservation_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get();
        
        // Initialize return data
        $data = [
            'total_count' => $reservations->count(),
            'daily_counts' => [],
        ];
        
        // Group by date
        $reservationsByDate = $reservations->groupBy('reservation_date');
        
        // Generate data for each day in range
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');
            $data['daily_counts'][$dateKey] = isset($reservationsByDate[$dateKey]) ? $reservationsByDate[$dateKey]->count() : 0;
        }
        
        return $data;
    }

    /**
     * Generate date labels for charts
     */
    private function generateDateLabels($startDate, $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);
        $labels = [];
        
        foreach ($period as $date) {
            $labels[] = $date->format('M d');
        }
        
        return $labels;
    }

    /**
     * Export analytics data
     */
    public function export(Request $request)
    {
        // Get current restaurant
        $restaurant = $this->getRestaurant();
        if (!$restaurant) {
            abort(403, 'No restaurant found for this user.');
        }
        
        // Default date range (last 30 days)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        
        // Convert to Carbon instances for easier manipulation
        $startDateCarbon = Carbon::parse($startDate);
        $endDateCarbon = Carbon::parse($endDate);
        
        // Get analytics data
        $ordersData = $this->getOrdersAnalytics($startDateCarbon, $endDateCarbon, $restaurant);
        $expensesData = $this->getExpensesAnalytics($startDateCarbon, $endDateCarbon, $restaurant);
        $reservationsData = $this->getReservationsAnalytics($startDateCarbon, $endDateCarbon, $restaurant);
        
        // Generate CSV content
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="analytics-export-' . date('Y-m-d') . '.csv"',
        ];
        
        $callback = function() use ($ordersData, $expensesData, $reservationsData, $startDateCarbon, $endDateCarbon) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, ['Date', 'Orders Count', 'Orders Amount', 'Expenses Count', 'Expenses Amount', 'Reservations Count']);
            
            // Data rows
            $period = CarbonPeriod::create($startDateCarbon, $endDateCarbon);
            foreach ($period as $date) {
                $dateKey = $date->format('Y-m-d');
                fputcsv($file, [
                    $date->format('Y-m-d'),
                    $ordersData['daily_counts'][$dateKey] ?? 0,
                    $ordersData['daily_amounts'][$dateKey] ?? 0,
                    $expensesData['daily_counts'][$dateKey] ?? 0,
                    $expensesData['daily_amounts'][$dateKey] ?? 0,
                    $reservationsData['daily_counts'][$dateKey] ?? 0,
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('analytics::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('analytics::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('analytics::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
