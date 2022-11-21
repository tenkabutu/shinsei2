<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskRewriteBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tasklist;
    public $type;

    public function __construct($tasklist,$type)
    {
        $this->tasklist = $tasklist;
        $this->type = $type;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.task-rewrite-box');
    }
}
