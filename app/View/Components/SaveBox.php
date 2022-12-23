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
    public $status,$role,$type;
    //public $type;
    public function __construct($status,$role,$type)
    {
        $this->status = $status;
        $this->role = $role;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if($this->type==1){
            return view('components.savebox.save-box-ov');
        }elseif($this->type==2){
            return view('components.savebox.save-box-pa');
        }elseif($this->type==3){
            return view('components.savebox.save-box-te');
        }
    }
}
