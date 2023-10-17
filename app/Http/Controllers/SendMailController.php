<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    // form
    // send_emails

    public function form() {
        return view('send_email_form');
    }
    
    public function send_emails(Request $request) {
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // return $request->all();
        $details=[
            'title'=>$request->title,
            'body'=>$request->body,
        ];

        $job =(new SendMailJob($details));
        dispatch($job);

        return back()->with('status', 'Mails Sent Successfully');
    }
}
