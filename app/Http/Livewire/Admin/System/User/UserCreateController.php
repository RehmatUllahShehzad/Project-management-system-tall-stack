<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Models\Admin\Team;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserCreateController extends UserAbstract
{
    /**
     * Called when the component has been mounted.
     *
     * @return void
     */
    public function mount()
    {
        $this->user = new User();

        $this->teams = Team::all();

        $this->roles = Role::all();

        $this->role = null;
    }

    public function render(): View
    {
        return $this->view('admin.system.user.user-create-controller');
    }
    
    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'user.name' => 'required|string|max:30|unique:'.get_class($this->user).',name',
            'user.email' => 'required|email|max:50|unique:' . get_class($this->user) . ',email',
            'role' => 'required',
            'teams' => 'required',
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'string',
        ];
    } 

    /**
     * Define the validation messagess.
     *
     * @return array<mixed>
     */
    protected $messages = [
        'user.name.required' => 'Please enter a name.',
        'user.name.unique' => 'This name already exits.',
        'user.email.required' => 'Please enter an email.',
        'user.email.unique' => 'Please enter a unique email.',
        'role' => 'Please select a role.',
        'teams' => 'Please select a team.',
    ];

    public function create(): void
    {
        $this->validate();
     
        $this->user->password = Hash::make($this->password);

        $this->user->save();
        
        $this->user->assignRole($this->role);

        $this->user->teams()->sync($this->teams);

        $this->notify('User Created', 'admin.system.user.index');
    }
}
