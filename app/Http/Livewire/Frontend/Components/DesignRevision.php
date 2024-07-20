<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Design;
use Livewire\Component;

class DesignRevision extends Component
{

    public Design $design;

    public function render()
    {
        return view('frontend.components.design-revision');
    }

    public function delete(int $id)
    {
        if($this->design->revisions->first()->id !== $id){
            $this->design->revisions->find($id)->delete();
        }

        return to_route('design.feedback', [$this->design->project->id, $this->design->id, $this->design->latestRevision->id]);
    }
}
