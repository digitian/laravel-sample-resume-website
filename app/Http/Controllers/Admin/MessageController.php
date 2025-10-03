<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(): View {
        $messages = Message::latest()->get();
        return view('admin.modules.messages.index', compact('messages'));
    }

    public function viewMessage(Message $message): View {
        if ($message->seen === 0) {
            $message->seen = 1;
            $message->save();
        }

        return view('admin.modules.messages.view', compact('message'));
    }

    public function destroyMessage(Message $message): RedirectResponse {

        $message->delete();

        notyf()->info(__('admin.message_deleted'));

        return redirect()->route('admin.messages.index');
    }
}
