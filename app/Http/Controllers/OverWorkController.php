<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Matter;
use App\Models\Task;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OverWorkController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);


        return view('overwork.create_ov',compact('user'));

    }
    public function save(Request $request){

        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],
                //'user_id' => ['required', 'integer', 'max:255']
                //'starttime' => ['required', 'string', 'email', 'max:255', 'unique:users']

        ]);
        //var_dump($request->device_name);
        /* $date=Carbon::now()->toDateTimeString();
        $matter = new Matter();
        if($request->etc3==1){
            $request->merge(['delivery_order' =>$date]);
        } */
        $matter = new Matter();
        $matter ->fill($request->except('_token'))->save();

        $request->session()->regenerateToken();
        $id = $matter->id;

        //event(new Registered($user));

        //@foreach ($records as $id =>$record)
        return  redirect($id.'/rewrite_ov');
    }
    public function save_request(Request $request){
        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],
        ]);
        $matter = new Matter();
        $request->merge(['status' =>2]);
        $date=Carbon::now()->toDateTimeString();
        $request->merge(['matter_request_date' =>$date]);
        $matter ->fill($request->except('_token'))->save();
        $request->session()->regenerateToken();
        $id = $matter->id;
        return  redirect($id.'/rewrite_ov');
    }

    public function update(Request $request,$id){

        print_r($_REQUEST);
        exit;

        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],

        ]);

        $matter =matter::find($id);
        $matter->fill($request->except('_token'));

        if($matter->isDirty()&&$request->change_check==1){
            $matter->status=1;
            $matter->save();
            return  redirect($id.'/rewrite_ov');
        }elseif($matter->isDirty()){

            $request->merge(['change_check' =>1]);
            return back()->withInput()->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');

        }

        $request->session()->regenerateToken();
        //$id = $matter->id;
        return  redirect($id.'/rewrite_ov');
    }
    public function update_request(Request $request,$id){
        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],

        ]);

        $matter =matter::find($id);
        $matter->fill($request->except('_token'));
        if($matter->isDirty()&&$request->change_check==1){
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_request_date=$date;
            $matter->status=1;
            $matter->save();
            return  redirect($id.'/rewrite_ov');
        }elseif($matter->isDirty()){

            $request->merge(['change_check' =>2]);
            return back()->withInput()->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');

        }



        $task = new Task();
        foreach($request->task_group as $row){
            if(isset($row['task_id'])){
                $task::find($row['task_id']);
                $task->fill($row);
                //タスクが既存であれば更新があったかどうかと、申請済みかどうかをチェック
                if($task->isDirty()&&$row['task_status']==2){
                    if($request->change_check2==1){
                        $request->merge(['change_check2' =>2]);
                        return back()
                            ->withInput()
                            ->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？2'.$row["task_change_date"]);


                    }

                }elseif($task->isDirty()){
                    //更新があって申請済みでなければ保存

                    $task->save();
                }

            }elseif($row['task_change_date']){
               // $request->validate([
                //        'matter_change_date' => ['required', 'string', 'max:55'],
              //          'task_breaktime' => ['required', 'string', 'max:255'],
               //
           //     ]);
                //タスクが新規であればそのまま保存
                //$task->task_starttime = $row['task_hour1'].":".$row['task_minutes1'];
                //$task->task_endtime = $row['task_hour2'].":".$row['task_minutes2'];
                $task->task_allotted = ((int)$row['task_hour2']*60+(int)$row['task_minutes2'])-((int)$row['task_hour1']*60+(int)$row['task_minutes1']);
                $task->task_status =2;
                $task->matter_id =$id;

                $task->fill($row)->save();
            }
        }

        $request->session()->regenerateToken();
       // $id = $matter->id;
        return  redirect($id.'/rewrite_ov');
    }
    public function task_save($tasklist,$matter_id,$save_type,$change_check2){
        $task = new Task();
        foreach($tasklist as $row){
            if(isset($row['task_id'])){
                $task::find($row['task_id']);
                $task->fill($row);
                //タスクが既存であれば更新があったかどうかと、申請済みかどうかをチェック
                if($task->isDirty()&&$row['task_status']==2){
                    if($change_check2==1){

                    }

                }elseif($task->isDirty()){
                //更新があって申請済みでなければ保存

                    $task->save();
                }

            }else{
                //タスクが新規であればそのまま保存
                $task::create($row);
            }
        }

        $matter = matter::findOrFail($id);
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);

        return view('overwork.create_ov',compact('user','matter'));


    }
    public function show_ov($id){

        $matter = matter::with('tasklist')->findOrFail($id);
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);

        return view('overwork.create_ov',compact('user','matter'));


    }

}
