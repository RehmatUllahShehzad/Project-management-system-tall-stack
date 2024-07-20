<?php

namespace App\Http\Livewire\Frontend\Design;

use App\View\Components\Frontend\Layouts\MasterLayout;
use Illuminate\Contracts\View\View;

class DesignShowController extends DesignAbstract
{
    public function render(): View
    {
        return $this->view('frontend.design.design-show-controller');
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'design.name' => 'required|max:255|unique:'.get_class($this->design).',name,'.$this->design->id,
        ];
    }

    public function update(): void
    {
        $this->validate();

        $this->design->save();

        $this->notify('Design Updated');
    }
}
