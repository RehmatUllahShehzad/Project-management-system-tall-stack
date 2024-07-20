<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Models\User;
use App\Rules\PasswordValidator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterController extends Component
{
    public $confirmPassword;

    public function mount()
    {
        $this->user = new User();
        $this->initializeFields();
    }

    /**
     * Define the validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'user.name' => 'required|max:30',
            'user.email' => 'required|email:filter,rfc,dns|unique:users,email',
            'password' => [
                'required',
                'min:8',
                new PasswordValidator(),
            ],
            'confirmPassword' => 'required|same:password',
        ];
    }

    public function render()
    {
        return view('admin.auth.register-controller')->layout('admin.layouts.guest-layout')
                ->layoutData([
                    'title' => 'Register',
                ]);
    }

    public function register()
    {
        $this->validate();
        
        $this->user->password = bcrypt($this->password);
        $this->user->save();

        session()->flash('alert-success', trans('notifications.account_created'));

        Auth::loginUsingId($this->user->id);

        return to_route('admin.dashboard');
    }

    public function initializeFields()
    {
        $this->password = '';
        $this->confirmPassword = '';
    }
}
