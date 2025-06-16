<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\MailException;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new WelcomeEmail($this->user));

            Log::info('Welcome email sent successfully', [
                'user_id' => $this->user->id,
                'email' => $this->user->email
            ]);

        } catch (\Exception $e) {
            MailException::handleMailError($e, [
                'user_id' => $this->user->id,
                'email' => $this->user->email,
                'job' => 'SendWelcomeEmailJob'
            ]);

            // Don't fail the job, just log the error
        }
    }
}
