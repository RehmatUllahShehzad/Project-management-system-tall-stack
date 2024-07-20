<?php

namespace App\Http\Livewire\Admin\System\Team;

use App\Http\Livewire\Admin\System\SystemAbstract;
use App\Http\Livewire\Traits\ResetsPagination;
use App\Models\Admin\Team;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

class TeamIndexController extends SystemAbstract
{
    use WithPagination;
    use ResetsPagination;

    public string $search = '';

    public string $showTrashed = '';

    public function render(): View
    {
        return $this->view('admin.system.team.team-index-controller', function (View $view) {
            $view->with('teams', $this->getTeams());
        });
    }

    public function getTeams(): Paginator
    {
        $query = Team::query();
        
        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->showTrashed) {
            $query = $query->withTrashed();
        }

        return $query->paginate(10);
    }
}
