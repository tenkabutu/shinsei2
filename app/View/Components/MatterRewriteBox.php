<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MatterRewriteBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userdata,$matter,$typename;
    public function __construct($userdata,$matter,$typename)
    {
        $this->userdata = $userdata;
        $this->matter = $matter;
        $this->typename = $typename;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.matter-rewrite-box');
    }
}
