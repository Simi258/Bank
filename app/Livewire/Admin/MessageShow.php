<?php

namespace App\Livewire\Admin;

use App\Models\ContactUs;
use Livewire\Component;

class MessageShow extends Component
{
    public $id;

    public function mount($id)
    {
       $this->id = $id;
    }

    public function render()
    {
        $message = ContactUs::findorfail($this->id);
        return view('livewire.admin.message-show', compact('message'));
    }
    public function deleteMessage($messageId)
    {
        $message = ContactUs::findOrFail($messageId);
        $message->delete();
        return redirect('admin/messages/list')->with('deleted','Message Deleted');
    }
}
