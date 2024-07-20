<?php

namespace App\Http\Livewire\Frontend\Project;

use App\View\Components\Frontend\Layouts\MasterLayout;
use Illuminate\Contracts\View\View;

class ProjectShowController extends ProjectAbstract
{
    public function render(): View
    {
        return $this->view('frontend.project.project-show-controller');
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'project.name' => 'required|max:255|unique:'.get_class($this->project).',name,'.$this->project->id,
        ];
    }

    public function update(): void
    {
        $this->validate();

        $this->project->save();

        $this->notify('Project Updated');
    }
}
