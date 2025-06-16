@extends('admin.layouts.master')
@section('TitlePage', 'Dashbaoard')
@section('content')
<div class="content">
    <div class="row">

        <div class="row align-items-center">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash2.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $totalRevenue }}">${{ $totalRevenue }}</span> L.E</h5>
                        <h6>Total Revenue (EGP)</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash1.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{$revenueThisMonth}}">${{ $revenueThisMonth}}</span> L.E</h5>
                        <h6>Revenue This Monthly</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash4.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{$shippingThisMonth}}">${{$shippingThisMonth}}</span> L.E</h5>
                        <h6>Shipping Cost This Monthly</h6>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash3.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{$revenueLastMonth}}">${{$revenueLastMonth}}</span></h5>
                        <h6>Revenue Last Monthly ({{$lastMonthStartname}})</h6>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash3.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{$last30DaysSale}}">${{$last30DaysSale}}</span> L.E</h5>
                        <h6>Revenue Last 30 Days (EGP)</h6>
                        <h5><span class="counters" data-count="{{$revenueLastMonth}}">${{$revenueLastMonth}}</span> L.E</h5>
                        <h6>Revenue Last Monthly ({{$lastMonthStartname}})</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>{{$products}}</h4>
                        <h5>Total Products</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="package"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{$totalCustomers}}</h4>
                        <h5>Total Customers</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>{{$totalOrders}}</h4>
                        <h5>Total Orders</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>{{$totalDelivered}}</h4>
                        <h5>Total Delivered</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="shopping-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>{{$totalMessages}}</h4>
                        <h5>Messages</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="inbox"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{$totalPages}}</h4>
                        <h5>Pages</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="hash"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recent Orders</h4>
                    <a href="{{route('orders.index')}}" class="btn-sm btn-primary">
                        See More Orders
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datanew ">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Shipped date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lastOrders as $order)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td><a href="{{ route('order.detail', ['orderId' => $order->id]) }}">{{ $order->id }}</a></td>
                                        <td><a href="{{ route('order.detail', ['orderId' => $order->id]) }}">{{$order->name}}</a></td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y - D')}}</td>

                                        <td>
                                            @if($order->status == 'delivered')
                                                <span class="badges bg-lightgreen">Delivered</span>
                                            @elseif ($order->status == 'shipped')
                                                <span class="badges bg-lightyellow">Shipped</span>
                                            @elseif ($order->status == 'pending')
                                                <span class="badges bg-primary">Pending</span>
                                            @else
                                                <span class="badges bg-lightred fw-bold">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->payment_status == 'paid')
                                                <span class="badges bg-lightgreen">Paid</span>
                                            @else
                                                <span class="badges bg-lightred">Not Paid</span>
                                            @endif
                                        </td>
                                        <td>{{$order->grand_total}} EGP</td>
                                        <td>{{ $order->shipped_date ? $order->shipped_date : 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11">No records found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Top 10 Products</h4>
                    <div class="dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a href="productlist.html" class="dropdown-item">Product List</a></li>
                            <li><a href="addproduct.html" class="dropdown-item">Product Add</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Products</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top10Products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="productimgname">
                                            <a href="productlist.html">{{ $product->name }}</a>
                                        </td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-0">
        <div class="card-body">
            <h4 class="card-title">Recent Orders</h4>
            <div class="table-responsive dataview">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Customer Name</th>
                            <th>Total Spent</th>
                            <th>Last Order Date</th>
                            <th>Last Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($top10Customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>${{ number_format($customer->total_spent, 2) }}</td>
                                <td>
                                    @if($customer->last_order_date)
                                        {{ \Carbon\Carbon::parse($customer->last_order_date)->format('Y-m-d H:i:s') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $customer->last_order_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Purchase & Sales</h5>
                    <div class="graph-sets">
                        <ul>
                            <li>
                                <span>Sales</span>
                            </li>
                            <li>
                                <span>Purchase</span>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                2022 <img src="{{asset('admin/assets/img/icons/dropdown.svg')}}" alt="img" class="ms-2">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="sales_charts"></div>
                </div>
            </div> --}}
</div>
@endsection
