<?php

use App\Mail\OrderEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\MailException;
use Illuminate\Support\Facades\Log;


function orderEmail($orderId , $userType="customer"){
    try {
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

        Log::info('Order email sent successfully via helper function', [
            'order_id' => $orderId,
            'email' => $email,
            'user_type' => $userType
        ]);

    } catch (\Exception $e) {
        MailException::handleMailError($e, [
            'order_id' => $orderId,
            'user_type' => $userType,
            'function' => 'orderEmail'
        ]);
    }
}
