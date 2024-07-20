<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Http\Livewire\Traits\CanDeleteRecord;
use App\Http\Livewire\Traits\Notifies;
use App\Models\Admin\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserShowController extends UserAbstract
{
    use CanDeleteRecord, Notifies;

    public function mount()
    {
        $this->teams = Team::all();

        $this->roles = Role::where('guard_name', 'web')->get();

        $this->role = $this->user->roles->first()->name;

        $this->selectedTeams = $this->user->teams;
    }

    public function render(): View
    {
        return $this->view('admin.system.user.user-show-controller');
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'user.name' => 'required|string|max:30|unique:'.get_class($this->user).',name,'.$this->user->id,
            'user.email' => 'required|email|max:50|unique:' . get_class($this->user) . ',email,' . $this->user->id,
            'role' => 'required',
            'teams' => 'required',
            'password' => 'nullable|min:8|max:255|confirmed',
        ];
    } 

    protected $messages = [
        'user.name.required' => 'Please enter a name.',
        'user.name.unique' => 'This name already exits.',
        'user.email.required' => 'Please enter an email.',
        'user.email.unique' => 'Please enter a unique email.',
        'role' => 'Please select a role.',
        'teams' => 'Please select a team.',
    ];

    public function update(): void
    {
        $this->validate();

        if ($this->password) {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->save();

        $this->user->syncRoles($this->role);

        $this->user->teams()->sync($this->teams);

        $this->notify(trans('notifications.user.updated'));
    }

    public function delete(): void
    {
        $this->user->delete();

        $this->notify(trans('notifications.user.deleted'), 'admin.system.user.index');
    }
    
    /**
    * return field to verify for delete
    */
   public function getCanDeleteConfirmationField(): string
   {
       return $this->user->name;
   }
}
