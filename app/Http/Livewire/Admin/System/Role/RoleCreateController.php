<?php

namespace App\Http\Livewire\Admin\System\Role;

use App\Http\Livewire\Traits\Notifies;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class RoleCreateController extends RoleAbstract
{
    use Notifies;

    /**
     * Called when the component has been mounted.
     *
     * @return void
     */
    public function mount()
    {
        $this->role = new Role();
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'role.name' => 'required|string|max:30|unique:'.get_class($this->role).',name',
        ];
    }

    public function render(): View
    {
        return $this->view('admin.system.role.role-create-controller');
    }

    public function create(): void
    {
        $this->validate();

        $this->role->save();

        $this->notify(trans('notifications.role.created'), 'admin.system.role.index');
    }
}
