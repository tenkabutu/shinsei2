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
    public function __construct($userdata,$type)
    {
        $this->userdata = $userdata;
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
            $this->typename = "振替";
            return view('components.matterbox.mb-ov');
        }elseif($this->type==2){
            return view('components.matterbox.mb-pa');
        }elseif($this->type==3){
            $this->typename = "テレワーク";
            return view('components.matter-box');
        }
    }
}
