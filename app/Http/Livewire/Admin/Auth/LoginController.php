<?php

namespace App\Http\Livewire\Admin\Auth;

use App\View\Components\Admin\Layouts\GuestLayout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginController extends Component
{
    public $email;

    public $password;

    public function render()
    {
        return view('admin.auth.login-controller')->layout(GuestLayout::class);
    }

    public function login()
    {
        $data = $this->validate([
            'email' => 'required|email:rfc,filter',
            'password' => 'required|max:190',
        ]);

        if (! Auth::guard('admin')->attempt($data)) {
            $this->addError('email', 'Invalid Credentials');

            return;
        }

        session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }
}
