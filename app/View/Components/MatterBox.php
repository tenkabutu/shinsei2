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


    public function render()
    {
        if($this->type==1){
            $this->typename = "作業";
            return view('components.matterbox.mb-ov');
        }elseif($this->type==2){
            $this->typename = "休暇";
            return view('components.matterbox.mb-pa');
        }elseif($this->type==3){
            $this->typename = "テレワーク";
            return view('components.matter-box');
        }elseif($this->type==4){
            $this->typename = "購入";
            return view('components.matterbox.mb-pu');
        }
    }
}
