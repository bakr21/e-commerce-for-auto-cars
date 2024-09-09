<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            margin-right: 20px;
        }
        .header h1 {
            margin: 0;
            color: #FFD333;
        }
        .order-details {
            margin-bottom: 20px;
        }
        .order-details p {
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #e6b400;
            color: white;
        }
        .total {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($mailData['userType'] == 'customer')
        <div class="header">
            <img src="{{asset('admin/assets/img/ZAKY_BAKR_LOGO3.svg')}}" alt="">
            <h1>Invoice for Your Order</h1>
        </div>
        @else 
        <div class="header">
            <img src="{{asset('admin/assets/img/ZAKY_BAKR_LOGO3.svg')}}" alt="">
            <h1>You have received an order <strong>{{$mailData['order']->id}}</strong></h1>
        </div>
        @endif
        <div class="order-details">
            <p><strong>Order ID:</strong> {{$mailData['order']->id}}</p>
            <p><strong>Order Date:</strong> {{ $mailData['order']->created_at->format('d-m-Y') }}</p>
            <p><strong>Customer:</strong> {{ $mailData['order']->name }}</p>
            <p><strong>Email:</strong> {{ $mailData['order']->email }}</p>
            <p><strong>Phone:</strong> {{ $mailData['order']->mobile }}</p>
            <p><strong>Address:</strong> {{ $mailData['order']->address }}</p>
            <p><strong>City - Country , ZIP:</strong> {{ $mailData['order']->city }} - {{ $mailData['order']->state }} , {{ $mailData['order']->zip }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mailData['order']->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->price, 2) }} EGP</td>
                    <td>{{ number_format($item->price * $item->qty, 2) }} EGP</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="order-details">
            <p>Please follow your status by visiting the profile page or <a href="{{route('website.account.orders')}}">click here</a></p>
            <p class="total">Subtotal: {{ number_format($mailData['order']->subtotal, 2) }} EGP</p>
            <p class="total">Discount: {{ number_format($mailData['order']->discount, 2) }} EGP</p>
            <p class="total">Shipping: {{ number_format($mailData['order']->shipping, 2) }} EGP</p>
            <p class="total">Grand Total: {{ number_format($mailData['order']->grand_total, 2) }} EGP</p>
        </div>

        <div class="footer">
            <p>Thank you for shopping with us!</p>
            <p>For any inquiries, please contact support@zakybakr.com</p>
        </div>
    </div>
</body>
</html>
