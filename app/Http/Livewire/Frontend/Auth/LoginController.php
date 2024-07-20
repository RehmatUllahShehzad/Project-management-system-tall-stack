<?php

namespace App\Http\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginController extends Component
{
    public $email;

    public $password;

    public function mount()
    {
        $this->resetFields();
    }

    /**
     * Define the validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function render()
    {
        return view('frontend.auth.login-controller')->layout('admin.layouts.guest-layout')
        ->layoutData([
            'title' => 'Login',
        ]);
    }

    public function login()
    {
        $this->validate();

        if (! Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('email', 'Invalid Credentials');

            return;
        }

        session()->regenerate();

        return redirect()->intended($this->redirect ?? route('dashboard'));
    }

    public function resetFields()
    {
        $this->email = '';
        $this->password = '';
    }
}
