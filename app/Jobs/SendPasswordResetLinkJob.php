<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use App\Exceptions\MailException;
use Illuminate\Support\Facades\Log;

class SendPasswordResetLinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The email address.
     *
     * @var string
     */
    protected $email;

    /**
     * Create a new job instance.
     *
     * @param  string  $email
     * @return void
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            Password::sendResetLink(['email' => $this->email]);

            Log::info('Password reset link sent successfully', [
                'email' => $this->email
            ]);

        } catch (\Exception $e) {
            MailException::handleMailError($e, [
                'email' => $this->email,
                'job' => 'SendPasswordResetLinkJob'
            ]);

            // Don't fail the job, just log the error
        }
    }
}
