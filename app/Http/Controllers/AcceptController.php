<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Matter;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AcceptController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function accept($id){

        /* $matter = matter::findOrFail($id); */
        $matter = matter::with('tasklist')->findOrFail($id);

        $task_allotted_count=0;
        if($matter->status!=3){
            $matter->status=3;
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_reply_date=$date;
            $matter->reception_id=Auth::id();

        }
        if($matter->matter_type==1){
        foreach($matter->tasklist as $task){
            if($task->task_status!=3){
                $task->task_status=3;
                $date=Carbon::now()->toDateTimeString();
                $task->task_reply_date=$date;
                $task->save();
            }
            $task_allotted_count+=$task->task_allotted;
        }
        $matter->allotted2=$task_allotted_count;
        }

        $matter->save();

        return back();
        //return  redirect($id.'/rewrite_ov');


    }
    public function redo($id){
        return  redirect($id.'/rewrite_ov');
    }
    public function reject($id){
        return  redirect($id.'/rewrite_ov');
    }
}
