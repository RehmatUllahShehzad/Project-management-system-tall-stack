<?php

namespace App\Http\Livewire\Frontend\Project;

use App\Http\Livewire\Traits\Notifies;
use App\Models\Project;
use App\Traits\VerifyProjectRelationAccess;
use App\View\Components\Frontend\Layouts\MasterLayout;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Closure;

class ProjectAbstract extends Component
{
    use Notifies;
    use VerifyProjectRelationAccess;

    public Project $project;


    public function mount()
    {
        $this->relationProjectAccess($this->project->id);
    }

    /**
     * @param  view-string  $view
     */
    public function view(string $view, Closure $closure = null): View
    {
        return tap(view($view), $closure)
            ->layout(MasterLayout::class, [
                'title' => 'Projects',
            ]);
    }
}