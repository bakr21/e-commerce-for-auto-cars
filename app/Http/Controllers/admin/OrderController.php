<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::latest('orders.created_at')->select('orders.*','users.name', 'users.email');
        $orders = $orders->leftjoin('users','users.id','orders.user_id');

        if ($request->get('keywords') != ''){
            $orders = $orders->where('users.name','like','%'.$request->keywords.'%');
            $orders = $orders->orWhere('users.email','like','%'.$request->keywords.'%');
            $orders = $orders->orWhere('orders.id','like','%'.$request->keywords.'%');
        }

        $orders = $orders->paginate(10);

        return view('admin.orders.index' , compact(
            'orders'
        
            ));
    }

    public function detail($orderId){
        $order = Order::select('orders.*','countries.name as countryName')
                    ->where('orders.id',$orderId)
                    ->leftjoin('countries','countries.id','orders.country_id')
                    ->first();
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        
        return view('admin.orders.detail', compact('order','orderItems'));
    }

    public function updateStatus(Request $request ,$orderId){
        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->shipped_date = $request->shipped_date;

        $order->save();
        flash()->addInfo('Order updated successfully', ['timeOut' => 20000]);


        return response()->json([
            'status' => true,
            'message' => 'Order updated successfully'
        ]);
    }

    public function sendInvoiceEmail(Request $request, $orderId){
        orderEmail($orderId, $request->userType);
        flash()->addSuccess('Invoice email sent successfully', ['timeOut' => 20000]);
        return response()->json([
            'status' => true,
            'message' => 'Invoice email sent successfully'
        ]);

    }

}
