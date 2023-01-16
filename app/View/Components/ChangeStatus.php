<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChangeStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $matter,$typename;
    public function __construct($matter,$type)
    {
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
        if($this->type==1){
            $this->typename = "振替作業";
        }elseif($this->type==2){
            $this->typename = "休暇取得";
        }elseif($this->type==3){
            $this->typename = "テレワーク勤務";
        }
        return view('components.change-status');

    }
}
