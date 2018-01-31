<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\User;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailApprover extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $data)
    {
        //
        //initialize user model
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        //
        $mailer->send('emails.manager-approve',['data'=>$this->data], function($m){

            $m->to($this->user->email, $this->user->first_name . ' ' . $this->user->last_name);
            $m->replyTo(config('mail.reply_to.address'), config('mail.reply_to.name'));
            $m->subject(trans('mail.Approve_asset_delivery'));
        });

    }
}
