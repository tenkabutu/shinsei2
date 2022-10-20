<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChangeStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $matter;
    public function __construct($matter)
    {
        $this->matter = $matter;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.change-status');
    }
}
