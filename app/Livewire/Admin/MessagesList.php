<?php

namespace App\Livewire\Admin;

use App\Models\ContactUs;
use Livewire\Component;
class MessagesList extends Component
{
    public function render()
    {
        return view('livewire.admin.messages-list',[
            'messages' => ContactUs::latest()
                ->paginate(18)->withQueryString()
        ]);
    }
    public function deleteMessage($messageId)

    {

        $message = ContactUs::findOrFail($messageId);

        $message->delete();

        return redirect()->with('deleted','Message deleted successfully');
    }
}
