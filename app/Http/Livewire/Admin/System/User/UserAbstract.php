<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Http\Livewire\Admin\System\SystemAbstract;
use App\Http\Livewire\Traits\Notifies;
use App\Models\User;

abstract class UserAbstract extends SystemAbstract
{
    use Notifies;

    public User $user;
    
    public $roles;

    public $role;

    public $teams;

    public $selectedTeams;

    /**
     * The new password for the staff member.
     *
     * @var string
     */
    public $password;

    /**
     * The password confirmation for the staff member.
     *
     * @var string
     */
    public $password_confirmation;

    /**
     * Listener for when password is updated.
     *
     * @return void
     */
    public function updatedPassword()
    {
        $this->validateOnly('password');
    }

    /**
     * Listener for when password confirmation is updated.
     *
     * @return void
     */
    public function updatedPasswordConfirmation()
    {
        $this->validateOnly('password');
    }
}
