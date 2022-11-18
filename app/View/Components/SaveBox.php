<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SaveBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $status;
    public $role;
    public function __construct($status,$role)
    {
        $this->status = $status;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.save-box');
    }
}
