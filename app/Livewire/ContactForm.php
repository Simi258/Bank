<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message = '';

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required|min:50',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create a new ContactUs entry with the user's email and message
        $contact = new ContactUs();
        $contact->name = $user->name;
        $contact->users_id = $user->id; // set the users_id value
        $contact->email = $user->email;
        $contact->message = $this->message;
        $contact->save();

        // Redirect back to the previous page with a success message
        session()->flash('success', 'Your message has been sent!');
    }
}
