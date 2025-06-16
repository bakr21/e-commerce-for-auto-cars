<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class MailException extends Exception
{
    public static function handleMailError($exception, $context = [])
    {
        // Log the mail error
        Log::error('Mail sending failed: ' . $exception->getMessage(), [
            'exception' => $exception,
            'context' => $context,
            'trace' => $exception->getTraceAsString()
        ]);
        
        // You can add additional handling here like:
        // - Sending notification to admin
        // - Storing failed emails in database
        // - Using alternative mail service
        
        return false;
    }
}
