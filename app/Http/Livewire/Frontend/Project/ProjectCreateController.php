<?php

namespace App\Http\Livewire\Frontend\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProjectCreateController extends ProjectAbstract
{
    public function mount(): void
    {
        $this->project = new Project();
    }

    /**
     * @return array<mixed>
     */
    public function rules()
    {
        return [
            'project.name' => 'required|max:255',
        ];
    }

    public function render(): View
    {
        return $this->view('frontend.project.project-create-controller');
    }

    /**
     * @return RedirectResponse | void
     */
    public function store()
    {
        $teams = User::find(Auth::id())->teams()->select('team_id')->get()->pluck('team_id')->toArray();

        $this->validate();

        $this->project->save();

        try {
            $teams = Auth::user()->teams()->select('team_id')->pluck('team_id');

            $this->project->teams()->attach($teams);

            $this->project->users()->attach(Auth::id());
        } catch (\Exception $ex) {
            //
        }

        $this->project->name = '';

        $this->notify(
            'Project Created Successfully',
            'project.index'
        );
    }
}
