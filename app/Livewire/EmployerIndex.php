<?php
namespace App\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Employers information')]
class EmployerIndex extends Component
{
    public $search = '';
    protected $queryString = ['search'];

    public function render()
    {
        $employers = User::where('user_type', 'employer')
            ->when($this->search, function ($query, $search)
            {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(8)
            ->withQueryString();

        return view('livewire.employer-index', [ 'employers' => $employers ]);

    }
    public function show($id)
    {
        $user = Auth::user();
        $employers = User::where('user_type', "employer")->findOrFail($id);
        return view('employ.info-employ',  compact('employers') );
    }
}
