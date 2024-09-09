<?php

use App\Mail\OrderEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;


function orderEmail($orderId , $userType="customer"){
    $order = Order::where('id', $orderId)->with('items')->first();

    if ($userType == 'customer'){
        $subject = 'Invoice for Your Order'; 
        $email = $order->email;

    } else {
        $subject = 'You have received an Order (admin)';
        $email = env('ADMIN_EMAIL');
    }

    $mailData = [
        'subject' => $subject,
        'order' => $order,
        'userType' => $userType,
    ]; 
    Mail::to($email)->send(new OrderEmail($mailData));
}