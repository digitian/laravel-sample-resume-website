<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendMessage(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max: 100'],
            'email' => ['required', 'string', 'max: 150'],
            'message' => ['required', 'string', 'max: 1000'],
            // reCAPTCHA v3: required + action + min score (0.5 default)
            'g-recaptcha-response' => ['required', 'recaptchav3:send-message,0.5'],
        ]);

        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        notyf()->success(__('contact.success'));

        return back();
    }
}
