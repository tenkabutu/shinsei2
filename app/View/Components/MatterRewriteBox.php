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
    public $userdata;
    public $matter;
    public function __construct($userdata,$matter,$type)
    {
        $this->userdata = $userdata;
        $this->matter = $matter;
        $this->type = $type;
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
