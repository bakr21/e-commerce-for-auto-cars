@extends('admin.layouts.master')
@section('TitlePage', 'catdasn')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Orders List</h4>
            <h6>Manage your Order</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{asset('admin/assets/img/icons/search-white.svg')}}"
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{asset('admin/assets/img/icons/pdf.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{asset('admin/assets/img/icons/excel.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{asset('admin/assets/img/icons/printer.svg')}}" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Reference No">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select">
                                    <option>Completed</option>
                                    <option>Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <a class="btn btn-filters ms-auto"><img
                                        src="assets/img/icons/search-whites.svg" alt="img"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table  datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>                                    
                                </label>
                            </th>
                            <th>#</th>
                            <th width="20">Customer Name</th>
                            <th>Date</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Shipped date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order) 
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
                            <td>{{$order->email}}</td>
                            <td>{{$order->mobile}}</td>

                            <td>
                                @if($order->status == 'delivered')
                                <span class="badges bg-lightgreen">Delivered</span>
                                @elseif ($order->status == 'shipped')
                                <span class="badges bg-lightyellow">Shipped</span>
                                @elseif ($order->status == 'pending')
                                <span class="badges bg-lightred">Pending</span>
                                @else 
                                <span class="badges bg-lightred fw-bold">Cancelled</span>
                                @endif
                            </td>
                            <td><span class="badges bg-lightgreen">Paid</span></td>
                            <td>{{$order->grand_total}} EGP</td>
                            <td>{{ $order->shipped_date ? $order->shipped_date : 'N/A' }}</td>
                            <td class="text-center">
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="sales-details.html" class="dropdown-item"><img
                                                src="assets/img/icons/eye1.svg" class="me-2" alt="img">Sale
                                            Detail</a>
                                    </li>
                                    <li>
                                        <a href="edit-sales.html" class="dropdown-item"><img
                                                src="assets/img/icons/edit.svg" class="me-2" alt="img">Edit
                                            Sale</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#showpayment"><img
                                                src="assets/img/icons/dollar-square.svg" class="me-2"
                                                alt="img">Show Payments</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#createpayment"><img
                                                src="assets/img/icons/plus-circle.svg" class="me-2"
                                                alt="img">Create Payment</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item"><img
                                                src="assets/img/icons/download.svg" class="me-2"
                                                alt="img">Download pdf</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"
                                            class="dropdown-item confirm-text"><img
                                                src="assets/img/icons/delete1.svg" class="me-2"
                                                alt="img">Delete Sale</a>
                                    </li>
                                </ul>
                            </td>
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
@endsection