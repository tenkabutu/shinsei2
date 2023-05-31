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
        if($this->type==1){
            return view('components.rulingbox.ruling-box-ov');
        }elseif($this->type==2){
            return view('components.rulingbox.ruling-box-pa');
        }elseif($this->type==3){
            return view('components.rulingbox.ruling-box-te');
        }elseif($this->type==4){
            return view('components.rulingbox.ruling-box-ovc');
        }elseif($this->type==5){
            return view('components.rulingbox.ruling-box-pac');
        }elseif($this->type==6){
            return view('components.rulingbox.ruling-box-tec');
        }
    }
}
