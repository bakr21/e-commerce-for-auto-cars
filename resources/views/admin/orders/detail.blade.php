@extends('admin.layouts.master')
@section('TitlePage', 'catdasn')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Order Details</h4>
            <h6>View order details</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-sales-split">
                <h2>Order Detail : #{{$order->id}}</h2>
                <ul>
                    <li>
                        <a href="javascript:void(0);"><img src="assets/img/icons/edit.svg" alt="img"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="assets/img/icons/excel.svg" alt="img"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="assets/img/icons/printer.svg" alt="img"></a>
                    </li>
                </ul>
            </div>
            <div class="invoice-box table-height"
                style="max-width: 1600px;width:100%;overflow: auto;margin:15px auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                <table cellpadding="0" cellspacing="0"
                    style="width: 100%;line-height: inherit;text-align: left;">
                    <tbody>
                        <tr class="top">
                            <td colspan="4" style="padding: 5px;vertical-align: top;">
                                <table style="width: 100%;line-height: inherit;text-align: left;">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Customer Info</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$order->name}}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Email : {{$order->email}}
                                                    </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Phone : {{$order->mobile}}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$order->address}}</font>
                                                </font><br>
                                                <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$order->city}} , {{$order->countryName}} {{$order->zip}}</font>
                                                </font><br>
                                            </td>
                                            <td
                                                style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Invoice Info</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Reference :</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Payment Status :</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Status :</font>
                                                </font><br>
                                            </td>
                                            <td
                                                style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        &nbsp;</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$order->id}} </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">
                                                        Paid</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    @if ($order->status == 'pending')
                                                    <span class="text-danger">Pending</span>
                                                    @elseif ($order->status == 'shipped')
                                                    <span class="text-info">Shipped</span>
                                                    @elseif ($order->status == 'delivered')
                                                    <span class="text-success">Delivered</span>
                                                    @else
                                                    <span class="text-danger">Canceled</span>
                                                    @endif  
                                                    
                                                </font><br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="heading " style="background: #F3F2F7;">
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Product Name
                            </td>
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                QTY
                            </td>
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Price
                            </td>
                            
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Total
                            </td>
                        </tr>
                        @forelse ($orderItems as $item)
                        <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                            <td
                                style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                                    {{$item->name}}
                                </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$item->qty}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$item->price}}      
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$item->total}}          
                            </td>
                        </tr>
                            
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 10px; vertical-align: top; ">
                                    No products found for this order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="container">
                <div class="row">
                    <!-- النموذج الأول -->
                    <div class="col-lg-6 col-md-12 mb-3">
                        <form method="post" action="{{ route('order.updatestatus', $order->id) }}" name="changeOrderStatusForm" id="changeOrderStatusForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Shipped time</label>
                            
                                    <div class="input-groupicon">
                                        <input type="text" name="shipped_date" placeholder="DD-MM-YYYY" value="{{old($order->shipped_date)}}" class="datetimepicker">
                                        <div class="addonset">
                                            <img src="{{asset('admin/assets/img/icons/calendars.svg')}}" alt="img">
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="select">
                                    <option value="pending" {{($order->status == 'pending') ? 'selected' : ''}}>pending</option>
                                    <option value="shipped" {{($order->status == 'shipped') ? 'selected' : ''}}>shipped</option>
                                    <option value="delivered" {{($order->status == 'delivered') ? 'selected' : ''}}>delivered</option>
                                    <option value="cancelled" {{($order->status == 'cancelled') ? 'selected' : ''}}>cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm me-2">Update</button>
                            <a href="{{ route('orders.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
                        </form>
                    </div>
            
                    <!-- النموذج الثاني -->
                    <div class="col-lg-6 col-md-12 mb-3">
                        <form action="" method="post" name="sendInvoiceEmail" id="sendInvoiceEmail" >
                            <div class="form-group">
                                <label>Send invoice Email</label>
                                <select name="userType" id="userType" class="select">
                                    <option value="customer" {{($order->status == 'pending') ? 'selected' : ''}}>Customer</option>
                                    <option value="admin" {{($order->status == 'shipped') ? 'selected' : ''}}>Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm me-2">Send</button>
                            <a href="{{ route('orders.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            
                    <div class="row">
                        <div class="col-lg-6 ms-auto">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h5>{{ $order->subtotal}} EGP</h5>
                                    </li>
                                    <li>
                                        <h4>Discount {{ (!empty($order->code)) ? '('.$order->coupon_code.')' : ''}}</h4>
                                        <h5>{{ $order->discount}} EGP</h5>
                                    </li>
                                    <li>
                                        <h4>Shipping</h4>
                                        <h5>{{ $order->shipping}} EGP</h5>
                                    </li>
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5>{{ $order->grand_total}} EGP</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    
                </div>
        </div>
    </div>
</div>

<script>
    $('#sendInvoiceEmail').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serializeArray();

        $.ajax({
            url: '{{ route("order.sendInvoiceEmail",$order->id)}}',
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            dataType: 'json',
            success: function(response) {
                window.location.href = '{{ route('order.detail', $order->id)}}';
            }
        });
    });

    $('#changeOrderStatusForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serializeArray();
        var url = $(this).attr('action');

        $.ajax({
            url: url,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    window.location.href = '{{ route('order.detail', $order->id) }}';
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
</script>

@endsection