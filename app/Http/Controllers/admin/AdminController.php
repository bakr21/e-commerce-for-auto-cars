<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function dashboard()
    {
            $data['products'] = Product::count();
            $data['totalCustomers'] = User::where('type', 0)->count();
            $data['totalOrders'] = Order::where('status', '!=', 'cancelled')->count();
            $data['totalDelivered'] = Order::where('status', '=', 'delivered')->count();
            $data['totalMessages'] = Message::count();
            $data['totalRevenue'] = Order::where('status', '!=', 'cancelled')->where('payment_status', 'paid')->sum('grand_total');
            $data['totalPages'] = Page::count();
            $data['lastMonthStartname'] = Carbon::now()->subMonth()->startOfMonth()->format('M');

            $data['lastOrders'] = Order::latest('orders.created_at')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.*', 'users.name', 'users.email')
            ->limit(10)
            ->latest()->get();


            // Revenue This Month
            $data['revenueThisMonth'] = $this->getRevenueThisMonth();
            // Revenue Last Month
            $data['revenueLastMonth'] = $this->getRevenueLastMonth();
            // Reverse last 30 days sale
            $data['last30DaysSale'] = $this->getLast30DaysSale();
            // shipping this month
            $data['shippingThisMonth'] = $this->getShippingThisMonth();
            // Top 10 most sold products
            $data['top10Products']  = $this->getTop10Products();
            // Top 10 customers
            $data['top10Customers'] = $this->getTop10Customers();

            return view('admin.index', $data );
        }
    public function getSlug(Request $request)
    {
            if ($request->has('title')) {
            $slug = Str::slug($request->input('title'));

            return response()->json([
                    'status' => true,
                    'slug' => $slug
            ]);
            }

            return response()->json([
            'status' => false,
            'slug' => null
            ]);
    }
    private function getRevenueThisMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        return Order::where('status', '!=', 'cancelled')
            ->where('payment_status', 'paid')
            ->whereDate('created_at','>=', $startOfMonth)
            ->whereDate('created_at','<=', $currentDate)
            ->sum('grand_total');
    }

    private function getRevenueLastMonth()
    {
        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        return Order::where('status', '!=', 'cancelled')
            ->where('payment_status', 'paid')
            ->whereDate('created_at','>=', $lastMonthStartDate)
            ->whereDate('created_at','<=', $lastMonthEndDate)
            ->sum('grand_total');
    }

    private function getLast30DaysSale()
    {
        $last30DayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        return Order::where('status', '!=', 'cancelled')
            ->where('payment_status', 'paid')
            ->whereDate('created_at','>=', $last30DayStartDate)
            ->whereDate('created_at','<=', $currentDate)
            ->sum('grand_total');
    }

    private function getShippingThisMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        return Order::where('status', '!=', 'cancelled')
            ->where('payment_status', 'paid')
            ->whereDate('created_at','>=', $startOfMonth)
            ->whereDate('created_at','<=', $currentDate)
            ->sum('shipping');
    }

    private function getTop10Products()
    {
        return Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', DB::raw('SUM(order_items.qty) as total_qty'), 'order_items.price')
            ->groupBy('products.id', 'products.name', 'order_items.price')
            ->orderBy('total_qty', 'desc')
            ->limit(10)
            ->get();
    }

    private function getTop10Customers()
    {
        $top10Customers = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email', DB::raw('SUM(orders.grand_total) as total_spent'))
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('total_spent', 'desc')
            ->limit(10)
            ->get();

        foreach ($top10Customers as $customer) {
            $lastOrder = Order::where('user_id', $customer->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $customer->last_order_date = $lastOrder ? $lastOrder->created_at : null;
            $customer->last_order_status = $lastOrder ? $lastOrder->status : null;
        }

        return $top10Customers;
    }

}
