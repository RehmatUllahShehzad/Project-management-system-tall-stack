<?php

namespace App\View\Components\Admin\Components;

use Illuminate\View\Component;

class Select2 extends Component
{
    public $options;

    public $selectedOptions;

    /**
     * Whether or not the input has an error to show.
     *
     * @var bool
     */
    public bool $error = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options, $selectedOptions, $error = false)
    {
        $this->selectedOptions = $selectedOptions;
        
        $this->options = $options;

        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.select2');
    }
}
