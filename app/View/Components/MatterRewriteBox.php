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
        //return view('components.matter-rewrite-box');
        if($this->type==1){
            $this->typename = "作業";
            return view('components.matterbox.mrb-ov');
        }elseif($this->type==2){
            $this->typename = "休暇";
            return view('components.matterbox.mrb-pa');
        }elseif($this->type==3){
            $this->typename = "テレワーク";
            return view('components.matter-rewrite-box');
        }
    }
}
