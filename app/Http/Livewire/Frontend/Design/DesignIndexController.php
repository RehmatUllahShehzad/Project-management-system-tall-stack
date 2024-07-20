<?php

namespace App\Http\Livewire\Frontend\Design;

use App\Http\Livewire\Traits\Notifies;
use App\Models\Project;
use App\Traits\VerifyProjectRelationAccess;
use App\View\Components\Frontend\Layouts\MasterLayout;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class DesignIndexController extends Component
{
    use Notifies, VerifyProjectRelationAccess;

    public Project $project;

    public Collection $designs;

    public function mount()
    {
        $this->relationProjectAccess($this->project->id);

        $this->designs = $this->project->designs;
    }

    public function render()
    {
        return view('frontend.design.design-index-controller')->layout(MasterLayout::class)->layoutData([
            'title' => 'Designs',
        ]);
    }

    public function delete($id): void
    {
        $this->designs->find($id)->delete();

        $this->notify('Design Deleted', 'design.index', $this->project->id);
    }
}
