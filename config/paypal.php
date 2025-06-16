<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'sandbox', // Explicitly set to sandbox to avoid any env issues
    'sandbox' => [
        'username'          => env('PAYPAL_SANDBOX_USERNAME', ''),
        'password'          => env('PAYPAL_SANDBOX_PASSWORD', ''),
        'signature'         => env('PAYPAL_SANDBOX_SIGNATURE', ''),
        'client_id'         => 'AR9IxLkiIqSvXHypXfQgUrM1jLVdunt_UXXwDoA5-4gb-k9KXn1UYPms1M-HspX_P-NKZK3dOUJUpR-w',
        'client_secret'     => 'ENv6b15NvI5MasMtmLjcd3z3sJHQ73ixEpDhK5AT-P8X9lJEu_00DpPIZrF0y8wdp6rH_l7RoaTcV-Hd',
        'app_id'            => 'APP-80W284485P519543T',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
