<?php

namespace App\Http\Livewire\Admin\System\Team;

use App\Http\Livewire\Traits\Notifies;
use App\Models\Admin\Team;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class TeamCreateController extends TeamAbstract
{
    use Notifies;

    /**
     * Called when the component has been mounted.
     *
     * @return void
     */
    public function mount()
    {
        $this->team = new Team();
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'team.name' => 'required|string|max:30|unique:'.get_class($this->team).',name',
        ];
    }

    /**
     * Define the validation messagess.
     *
     * @return array<mixed>
     */
    protected $messages = [
        'team.name.required' => 'Please enter a name for the team.',
    ];

    public function render(): View
    {
        return $this->view('admin.system.team.team-create-controller');
    }

    public function create(): void
    {        
        $this->validate();
        
        $this->team->save();

        $this->notify(trans('notifications.team.created'), 'admin.system.team.index');
    }
}
