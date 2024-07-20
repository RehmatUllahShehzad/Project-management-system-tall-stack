<?php

namespace App\Http\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutController extends Component
{
    public function render()
    {
        return view('admin.auth.logout-controller');
    }
    
    public function logout()
    {
        Auth::logout();
        session()->regenerate();

        return to_route('admin.login');
    }
}
