<?php
namespace App\Http\Controllers;
use App\Models\Account;
use App\Models\User;
use Illuminate\Validation\Rule;


//currently not in use
class AdminSectionController extends Controller
{

    public function index()
    {
        $dashboardItems = [
            [
                'icon' => 'people.png',
                'alt' => 'transaction',
                'route' => 'admin.customer',
                'label' => 'User\'s information',
            ],
            [
                'icon' => 'email.png',
                'alt' => 'email',
                'route' => 'admin/messages/list',
                'label' => 'Messages',
            ],
            [
                'icon' => 'add.account.png',
                'alt' => 'email',
                'route' => 'admin/add/user',
                'label' => 'Add new User',
            ],
            [
                'icon' => 'accept.png',
                'alt' => 'accept Transfer',
                'route' => 'admin/accept-transfer',
                'label' => 'Accept Transfer',
            ],
        ];
        return view('admin', compact('dashboardItems'));
    }
}
