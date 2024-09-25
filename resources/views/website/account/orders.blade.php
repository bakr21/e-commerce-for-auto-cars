@extends('website.layouts.master')
@section('TitlePage' , 'Orders')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('home')}}">Home</a>
                <span class="breadcrumb-item active">Orders</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-3">
            @include('website.account.account-panel')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="h5 mb-0 pt-2 pb-2"><i class="fa-solid fa-bag-shopping"></i> My Orders</h2>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead> 
                                <tr>
                                    <th>Orders #</th>
                                    <th>Date Purchased</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('website.account.orderdetail',$order->id)}}">ORD{{$order->id}}</a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y - D')}}</td>
                                    <td>

                                        @if($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                        @elseif ($order->status == 'shipped')
                                        <span class="badge bg-info">Shipped</span>
                                        @elseif ($order->status == 'pending')
                                        <span class="badge bg-danger">Pending</span>
                                        @else 
                                        <span class="badge bg-warning fw-bold">Cancelled</span>
                                        @endif  
                                        
                                    </td>
                                    <td>{{$order->grand_total}} EGP</td>
                                </tr>                                   
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
