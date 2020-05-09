<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use App\Events\SendingContactEmail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);
        event(new SendingContactEmail($data));
        return redirect()->back()->with('success', 'Email is Sending..');
    }
}
