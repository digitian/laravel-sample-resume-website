<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendMessage(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max: 100'],
            'email' => ['required', 'string', 'max: 150'],
            'message' => ['required', 'string', 'max: 1000'],
            'company_website' => ['nullable', function ($attr, $val, $fail) {
                if (filled($val)) $fail('Spam detected.');
            }],
            'started_at' => ['required','integer', function($a,$v,$fail) {
                if (Carbon::createFromTimestamp((int)$v)->diffInSeconds(now()) < 10) {
                    notyf()->error(__('contact.contact_error_1'));
                    $fail(__('contact.contact_error_1'));
                }
            }],
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
