<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\QrCode\QrCode;
use App\Models\User;
use Livewire\Component;

class UsersCount extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.users-count')->with([
            'users_count' => User::count(),
        ]);
    }
}
