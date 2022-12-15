<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RulingBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type,$role,$records;
    public function __construct($type,$role,$records)
    {
        $this->role = $role;
        $this->type = $type;
        $this->records = $records;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rulingbox.ruling-box-ov');
    }
}
