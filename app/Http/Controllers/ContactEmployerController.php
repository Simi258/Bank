<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ContactEmployerController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('contact', compact('user'));
    }


    public function store(Request $request)
    {
        // Redirect to the Livewire component
        return redirect()->route('contact-form');
    }

        public function messages()
    {
        return view('admin/customer-messages', [
            'messages' => ContactUs::latest()
                ->paginate(18)->withQueryString()
        ]);
    }

    public function read(int $id)
    {
        $message = ContactUs::findOrFail($id);

        if (!$message) {
            return redirect()->back()->withErrors(['message' => 'Message not found']);
        }

        session(['message_to_read' => $message]);
        return view('admin.messages-show', compact('message') );
    }

    public function deleteAndRead(int $id)
    {
        $message = ContactUs::find($id);

        if (!$message) {
            return redirect()->back()->withErrors(['message' => 'Message not found']);
        }

        $message->delete();
        // Store the message in the session to show it after redirect
        session(['message_to_read' => $message]);

        return redirect()->route('admin/customer-messages')->with('deleted', 'Message deleted successfully.');
    }
}
