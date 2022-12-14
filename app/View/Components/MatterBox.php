<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MatterBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userdata,$typename;
    public function __construct($userdata,$typename)
    {
        $this->userdata = $userdata;
        $this->typename = $typename;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.matter-box');
    }
}
