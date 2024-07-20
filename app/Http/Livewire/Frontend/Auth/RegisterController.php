<?php

namespace App\Http\Livewire\Frontend\Auth;

use App\Models\Admin\Invite;
use App\Models\User;
use App\Rules\PasswordValidator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterController extends Component
{
    public $confirmPassword;

    public $token;

    public function mount()
    {
        $this->user = new User();

        $this->initializeFields();
        
        $this->invite = Invite::where('token', $this->token)->first();
        $this->user->email = $this->invite->email;
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
        return view('frontend.auth.register-controller')
            ->layout('frontend.layouts.guest-layout')
            ->layoutData([
                'title' => 'Register',
            ]);
    }

    public function register()
    {
        $this->validate();

        $this->user->email = $this->invite->email;

        $this->user->password = bcrypt($this->password);

        $this->user->save();

        //add many to many relationship with team
        $this->user->teams()->attach($this->invite->team->id);

        //user has a role of user
        $this->user->assignRole('User');

        session()->flash('alert-success', trans('notifications.account_created'));
        
        Auth::loginUsingId($this->user->id);

        $this->invite->status = 0;

        $this->invite->save();

        return to_route('dashboard');
    }

    public function initializeFields()
    {
        $this->password = '';
        $this->confirmPassword = '';
    }
}
