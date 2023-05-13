<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function message(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($this->isOnline()){
            $details = [
                'recipient'=>"support@starapplianceservices.com",
                'name' => $request->name,
                'email' => $request->email,
                'subject' => 'Message',
                'phone' => $request->phone,
                'body' => $request->message,
            ];

            \Mail::send('email-template',$details,function ($message) use ($details){
                $message->to($details['recipient'])
                    ->from('no-reply@starapplianceservices.com',$details['name'],$details['phone'])
                    ->subject($details['subject']);
            });
            return redirect()->back()->with('success','Email sent');
        }
        else{
            return redirect()->back()->withInput()->with('error','Check your internet connection');
        }
    }
    public function book(Request $request)
    {
         $this->validate($request, [
            'names' => 'required|string|max:255',
            'emails' => 'required|email|max:255',
            'phones' => 'required|string|max:255',
            'messages' => 'required|string',
            'service' => 'required|string|max:55',
        ]);

         $body = 'Message '.$request->messages.'Number: '.$request->phones.' Service: '.$request->service;
        if ($this->isOnline()){
            $details = [
                'recipient'=>"support@starapplianceservices.com",
                'name' => $request->names,
                'email' => $request->emails,
                'subject' => 'Booking message',
                'service' => $request->serice,
                'phone' => $request->phones,
                'body' => $body,
            ];
            \Mail::send('email-template',$details,function ($message) use ($details){
                $message->to($details['recipient'])
                    ->from("no-reply@starapplianceservices.com",$details['name'])
                    ->subject($details['subject']);
            });
            return redirect()->back()->with('book_success','Email sent');
        }
        else{
            return redirect()->back()->withInput()->with('error','Check your internet connection');
        }

    }

    public function isOnline($site = "https://youtube.com/")
    {
        if (@fopen($site,"r")){
            return true;
        }
        else{
            return false;
        }
    }
}
