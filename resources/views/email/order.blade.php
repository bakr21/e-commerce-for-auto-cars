<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #FFD333;
            color: #ffffff;
            padding: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center;
        }
        .header img {
            max-width: 100px;
            margin-right: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .order-details {
            margin-bottom: 20px;
            padding: 20px;
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
            background-color: #FFD333;
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
            <img src="{{ asset('path_to_your_logo/logo.png') }}" alt="Website Logo" class="logo">
            <h1>Invoice for Your Order</h1>
        </div>
        @else 
        <div class="header">
            <img src="{{ asset('path_to_your_logo/logo.png') }}" alt="Website Logo" class="logo">
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
