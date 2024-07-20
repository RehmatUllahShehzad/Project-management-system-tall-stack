<?php

namespace App\Http\Livewire\Admin\System\Role;

use App\Http\Livewire\Traits\CanDeleteRecord;
use App\Http\Livewire\Traits\Notifies;
use Illuminate\Contracts\View\View;

class RoleShowController extends RoleAbstract
{
    use CanDeleteRecord;
    use Notifies;

    public function render(): View
    {
        return $this->view('admin.system.role.role-show-controller');
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'role.name' => 'required|string|max:30|unique:'.get_class($this->role).',name,'.$this->role->id,
        ];
    }

    public function update(): void
    {
        $this->validate();

        $this->role->save();

        $this->notify(trans('notifications.role.updated'));
    }

    public function delete(): void
    {
        $this->role->delete();

        $this->notify(trans('notifications.role.deleted'), 'admin.system.role.index');
    }

    /**
     * return field to verify for delete
     */
    public function getCanDeleteConfirmationField(): string
    {
        return $this->role->name;
    }
}
