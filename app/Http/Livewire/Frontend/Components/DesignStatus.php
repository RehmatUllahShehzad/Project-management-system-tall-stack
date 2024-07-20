<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Design;
use Livewire\Component;

class DesignStatus extends Component
{
    public Design $design;

    public $statuses = ['Approved', 'DL to review', 'TD to review', 'Waiting for client'];

    public function rules()
    {
        return [
            'design.status' => 'required|in:,'.implode(',', $this->statuses)
        ];
    }

    public function render()
    {
        return view('frontend.components.design-status');
    }

    public function updatedDesign()
    {
        $this->design->save();
    }
}
