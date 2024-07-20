<?php

namespace App\Http\Livewire\Frontend\Revision;

use App\Http\Livewire\Traits\Notifies;
use App\Models\Design;
use App\Traits\VerifyProjectRelationAccess;
use App\View\Components\Frontend\Layouts\MasterLayout;
use Closure;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class RevisionAbstract extends Component
{
    use Notifies;
    use VerifyProjectRelationAccess;

    public Design $design;

    public function mount()
    {
        $this->relationProjectAccess($this->design->project->id);
    }

    /**
     * @param  view-string  $view
     */
    public function view(string $view, Closure $closure = null): View
    {
        return tap(view($view), $closure)
                ->layout(MasterLayout::class, [
                    'title' => 'Designs',
                ]);
    }
}
