<?php

namespace App\Http\Livewire\Frontend\Design;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class DesignFeedbackController extends DesignAbstract
{
    public Collection $feedbacks;

    public function mount()
    {
        $this->feedbacks = $this->revision->feedbacks;
    }

    public function render(): View
    {
        return $this->view('frontend.design.design-feedback-controller');
    }
}
