<?php

namespace App\Http\Livewire\Frontend\Auth;

use App\Http\Livewire\Traits\Notifies;
use App\Models\User;
use App\Rules\PasswordValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ResetPasswordController extends Component
{
    use Notifies;

    public string $token;

    public string $email;

    public string $password = '';

    public string $confirm_password = '';

     /**
     * @var array<mixed>
     */
    protected $messages = [
        'email.exists' => 'No account found with given email',
    ];

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request('email', '');
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'bail|required|email:filter,rfc,dns|exists:users,email',
            'password' => [
                'required',
                'min:8',
                new PasswordValidator(
                    User::whereEmail($this->email)->firstOrFail(),
                    true
                ),
            ],
            'confirm_password' => 'required|same:password',
        ];
    }

    public function render()
    {
        return view('frontend.auth.reset-password-controller')->layout('frontend.layouts.guest-layout')
        ->layoutData([
            'title' => 'Reset Password',
        ]);
    }

     /**
     * @return \Illuminate\Http\RedirectResponse | void
     */
    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->confirm_password,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {

            $this->notify(
                trans('notifications.password-reset.password_updated')
            );

            Auth::logout();
            $this->email = '';
            $this->password = '';
            $this->confirm_password = '';

            return to_route('login');
        }

        $this->notify('Link has expired, Please request again!', level: 'error');
    }
}
