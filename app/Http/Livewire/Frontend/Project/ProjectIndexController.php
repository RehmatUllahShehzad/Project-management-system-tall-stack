<?php

namespace App\Http\Livewire\Frontend\Project;

use App\Models\Project;
use App\Http\Livewire\Traits\Notifies;
use App\View\Components\Frontend\Layouts\MasterLayout;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectIndexController extends Component
{
    use Notifies;

    public Collection $projects;

    public function mount()
    {

        $team_ids = Auth::user()->teams()->select('team_id')->pluck('team_id');

        $this->projects = Project::whereHas('teams', function ($q) use ($team_ids) {
            $q->whereIn('team_id', $team_ids);
        })->get();
    }

    public function render()
    {
        return view('frontend.project.project-index-controller')->layout(MasterLayout::class)->layoutData([
            'title' => 'Projects',
        ]);
    }

    public function delete($id): void
    {
        $this->projects->find($id)->delete();

        $this->notify('Project Deleted', 'project.index');
    }
}
