<?php

namespace App\Livewire\Admin;

use App\Models\transaction;
use App\Models\TransactionRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AcceptTransfer extends Component
{
    public $search = '';
    protected $queryString = ['search'];
    public $status = ['pending','accepted','declined',''];

    use WithPagination;
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function mount()
    {
        $this->status = '';
    }

    public function render()
    {
        $transactionRequests = $this->getTransactionRequests($this->search);

        $requests = transaction::where('transaction_process', $this->status);

        if ($this->status === 'accepted') {
            $requests = $requests->where('amount', '>', 5000);
        }

        $requests = $requests->paginate(10);

        return view('livewire.admin.accept-transfer', ['request' => $transactionRequests], ['requests' => $requests]);
    }

    private function getTransactionRequests($search)
    {
        $query = transaction::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('from_name', 'like', "%{$search}%")
                    ->orWhere('to_name', 'like', "%{$search}%")
                    ->orWhere('to_iban', 'like', "%{$search}%")
                    ->orWhere('from_iban', 'like', "%{$search}%")
                    ->orWhere('transaction_process', 'like', "%{$search}%");
            });
        }

        // Add a new query to filter the transactions based on the amount field
        $query->where('amount', '>', 5000);
        return $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

    }

    public function delete($id)

    {

        $message = transaction::findOrFail($id);

        $message->delete();

        return redirect()->with('deleted','Transaction request  deleted successfully');
    }
}
