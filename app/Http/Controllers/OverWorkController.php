<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShinseiRequest;
use App\Models\User;
use App\Models\Matter;
use App\Models\Task;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;


class OverWorkController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        /* $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);
        $userlist = $this->create_userlist();
        $query=user::query();
        $area_id=$user->area;

        $query->where(function($query2) use($area_id){
            $query2->whereIn('users.role',[1,2])
            ->Where('users.area', $area_id)
            ->Where('users.approval',2);
        })->orwhere(function($query2){
            $query2->whereIn('users.role',[1,2])
            ->Where('users.approval',1);
        });
            $check_userlist=$query->get(['id', 'name'])->all(); */
        $user = User::with('roletag', 'approvaltag', 'areatag', 'worktype', 'areas')
        ->findOrFail(Auth::user()->id);
        $userlist = $this->create_userlist();

        // ユーザーの担当エリアIDを取得
        $userAreaIds = $user->areas->pluck('id')->toArray();

        $query = User::query();

        $query->where(function ($query2) use ($userAreaIds) {
            $query2->whereIn('users.role', [1, 2])
            ->where('users.approval', 2)
            ->whereHas('areas', function ($query3) use ($userAreaIds) {
                $query3->whereIn('area_data.id', $userAreaIds);
            });
        })->orWhere(function ($query2) {
            $query2->whereIn('users.role', [1, 2])
            ->where('users.approval', 1);
        });

            $check_userlist = $query->get(['id', 'name'])->all();

            return view('overwork.create_ov',compact('user','check_userlist','userlist'));

    }
    public function save(ShinseiRequest $request){

        //var_dump($request->device_name);
        /* $date=Carbon::now()->toDateTimeString();
        $matter = new Matter();
        if($request->etc3==1){
            $request->merge(['delivery_order' =>$date]);
        } */
        $matter = new Matter();
        $carbon = new CarbonImmutable($request->matter_change_date);
        $request->merge(['nendo' =>$carbon->subMonthsNoOverflow(3)->format('Y')]);
        $matter ->fill($request->except('_token'))->save();
        $id = $matter->id;
        foreach($request->task_group as $row){
            if($row['task_change_date']){
                $task = new Task();
                $task->task_allotted = ((int)$row['task_hour2']*60+(int)$row['task_minutes2'])-((int)$row['task_hour1']*60+(int)$row['task_minutes1']);
                $task->task_status =1;
                $task->matter_id =$id;
                $task->fill($row)->save();
            }
        }

        $request->session()->regenerateToken();


        //event(new Registered($user));

        //@foreach ($records as $id =>$record)
        return  redirect($id.'/rewrite_ov');
    }
    public function save_request(ShinseiRequest $request){

        $matter = new Matter();
        $request->merge(['status' =>2]);
        $date=Carbon::now()->toDateTimeString();
        $request->merge(['matter_request_date' =>$date]);
        $carbon = new CarbonImmutable($request->matter_change_date);
        $request->merge(['nendo' =>$carbon->subMonthsNoOverflow(3)->format('Y')]);
        $matter ->fill($request->except('_token'))->save();
        $id = $matter->id;
        foreach($request->task_group as $row){
            if($row['task_change_date']){
                $task = new Task();
                $task->task_allotted = ((int)$row['task_hour2']*60+(int)$row['task_minutes2'])-((int)$row['task_hour1']*60+(int)$row['task_minutes1'])-(int)$row['task_breaktime'];
                $task->task_status =2;
                $date=Carbon::now()->toDateTimeString();
                $task->task_request_date=$date;
                $task->matter_id =$id;
                $task->fill($row)->save();
            }
        }
        $request->session()->regenerateToken();

        return  redirect($id.'/rewrite_ov');
    }

    public function update(ShinseiRequest $request,$id){
        $matter =matter::find($id);
        $matter->fill($request->except('_token'));

        if($matter->isDirty()&&$request->change_check==1){
            $matter->status=1;
            $matter->save();
            return  redirect($id.'/rewrite_ov');
        }elseif($matter->isDirty()){
            $request->merge(['change_check' =>1]);
            return back()
            ->withInput()
            ->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');

        }
        foreach($request->task_group as $row){
            if(isset($row['id'])){
                $task =task::find($row['id']);
                $task->matter_id =$id;
                $task->fill($row);

                //タスクが既存であれば更新があったかどうかと、申請済みかどうかをチェック
                if($task->isDirty()&&$row['task_status']==3){
                    if($request->change_check2==1){
                        $request->merge(['change_check2' =>2]);
                        return back()
                        ->withInput()
                        ->with(['save_check'=>'申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？'.$row["task_change_date"].':'.$row["task_minutes2"],
                                'old_task_group'=>$request->task_group
                        ]);

                    }
                    $task->task_status=2;
                }

                $task->update();


            }elseif($row['task_change_date']){
                $task = new Task();
                $task->task_allotted = ((int)$row['task_hour2']*60+(int)$row['task_minutes2'])-((int)$row['task_hour1']*60+(int)$row['task_minutes1'])-(int)$row['task_breaktime'];
                $task->task_status =2;
                $date=Carbon::now()->toDateTimeString();
                $task->task_request_date=$date;
                $task->matter_id =$id;
                $task->fill($row)->save();
            }
        }

        $request->session()->regenerateToken();
        return  redirect($id.'/rewrite_ov');
    }
    public function fix(ShinseiRequest $request,$id){
        $matter =matter::find($id);
        $request->merge(['proxy_id' =>Auth::id()]);
        $matter->fill($request->except('_token','user_id'));
        $matter->save();

        foreach($request->task_group as $row){
            if(isset($row['id'])){
                $task =task::find($row['id']);
                $task->matter_id =$id;
                $task->fill($row);
                $task->update();
            }elseif($row['task_change_date']){

                $task = new Task();
                $task->task_allotted = ((int)$row['task_hour2']*60+(int)$row['task_minutes2'])-((int)$row['task_hour1']*60+(int)$row['task_minutes1'])-(int)$row['task_breaktime'];
                $task->task_status =2;
                $date=Carbon::now()->toDateTimeString();
                $task->task_request_date=$date;
                $task->matter_id =$id;
                $task->fill($row)->save();



            }/* elseif($row['id']){
                $task->task_status=6;
                $task->save();
            } */
        }

        $request->session()->regenerateToken();
        return  redirect($id.'/rewrite_ov');
    }
    public function update_request(ShinseiRequest $request,$id){
        $matter =matter::find($id);
        $matter->fill($request->except('_token'));
        if($matter->isDirty()&&$request->change_check==1){
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_request_date=$date;
            $matter->status=2;
            $matter->save();





           // return  redirect($id.'/rewrite_ov');
        }elseif($matter->isDirty()){
            $request->change_check=1;
            return back()->withInput()
            ->with(['save_check'=>'申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？',
                'old_task_group'=>$request->task_group]);

        }

       // $task = new Task();
        foreach($request->task_group as $row){
            if(isset($row['id'])){
                $task =task::find($row['id']);
                $task->matter_id =$id;
                $task->fill($row);

                //タスクが既存であれば更新があったかどうかと、申請済みかどうかをチェック
                if($task->isDirty()){
                    if($request->change_check2==1){
                        $request->change_check2 =2;
                            return back()->withInput()
                            ->with(['save_check2'=>'申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？'.$row["task_change_date"].':'.$row["task_minutes2"],
                                    'old_task_group'=>$request->task_group
                            ]);

                    }
                    $task->task_status=2;
                }

                $task->update();

                /* }elseif($task->isDirty()){
                    //更新があって申請済みでなければ保存

                    $task->save();
                }
                $task->save(); */

            }elseif($row['task_change_date']){
                $task = new Task();

                $task->task_status =2;
                $date=Carbon::now()->toDateTimeString();
                $task->task_request_date=$date;
                $task->matter_id =$id;
                $task->fill($row);
                $task->task_allotted = ((int)$row['task_hour2']*60+(int)$row['task_minutes2'])-((int)$row['task_hour1']*60+(int)$row['task_minutes1'])-(int)$row['task_breaktime'];

                $task->save();
            }
        }

        $request->session()->regenerateToken();
       // $id = $matter->id;
        return  redirect($id.'/rewrite_ov');
    }

    public function show_ov($id){

        $matter = matter::with('tasklist')->findOrFail($id);
        //$task_count = task::where('matter_id',$id)->where('task_status',2)->count();
        $task_data = task::select(DB::raw('sum(task_allotted) as task_total,count(id) as task_count'))->where('matter_id',$id)->get()->all();




        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail($matter->user_id);
        //$user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);

        $query=user::query();
        $area_id=$user->area;

        $query->where(function($query2) use($area_id){
            $query2->whereIn('users.role',[1,2])
            ->Where('users.area', $area_id)
            ->Where('users.approval',2);
        })->orwhere(function($query2){
            $query2->whereIn('users.role',[1,2])
            ->Where('users.approval',1);
        });
        $check_userlist=$query->get(['id', 'name'])->all();


      //  with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);


        return view('overwork.create_ov',compact('user','matter','task_data','check_userlist'));


    }
    public function delete(Request $request,$id){
        $matter =matter::find($id);

        if($request->delete_check==1){
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_request_date=$date;
            $matter->status=6;
            $matter->save();
            $tasklist = $matter->tasklist;
            foreach ($tasklist as $us) {
                $us->task_status=6;
                $us->save();
            }
            $matter->tasklist();
            return  redirect($id.'/rewrite_ov');
        }else{
            $request->merge(['delete_check' =>1]);
            return back()->withInput()->with('delete_check', 'この申請を削除します、よろしいですか？');

        }
    }
    public static function create_userlist ()
    {
        $userlist = User::select('id','employee', 'name')->orderby('employee','asc')->get();
        $create_userlist = "";
        foreach ($userlist as $us) {
            $create_userlist .= '<option value="' . $us->id . '">' . $us->employee . ':' . $us->name . '</option>';
        }
        return $create_userlist;
    }


}
