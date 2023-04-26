<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function book(Request $request)
    {
         Validator::make($request->all(), [
            'names' => 'required|string|max:255',
            'emails' => 'required|email|max:255',
            'phones' => 'required|string|max:255',
            'messages' => 'required|string',
            'service' => 'required|string|max:255',
        ]);
        $book = new Book();
        $book->name = $request->names;
        $book->email = $request->emails;
        $book->phone = $request->phones;
        $book->message = $request->messages;
        $book->service = $request->service;

        $book->save();

        return redirect()->back()->with('book_success', 'Your message has been sent successfully!');

    }

    public function message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->message = $request->message;

        $message->save();

        return redirect()->back()->with('message_success', 'Your message has been sent successfully!');
    }
}
