<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use PDF;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $timeout=7200;
    public $pdf;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details=$details;
        // $this->pdf=$pdf;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $users = User::all();
        $input['title'] = $this->details['title'];
        $input['body'] = $this->details['body'];

        

        foreach ($users as $user) {
            $input['name'] = $user->name;
            $input['email'] = $user->email;
            // $pdf = PDF::loadView('mail.test_mail', $this->details);
            // $input['pdf']= $this->pdf;
            Mail::send('mail.test_mail',[ $input], function ($message) use ($input) {
                $message->to($input['email'], $input['name'])
                    ->subject($input['title']);
                    // ->attachData($this->pdf, 'information.pdf');
            });
            
        }

    }
}
