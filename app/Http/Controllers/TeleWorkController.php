<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Matter;
use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;


class TeleWorkController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);
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
            $check_userlist=$query->get('name')->all();

            return view('telework.create_te',compact('user','check_userlist'));

    }
    public function save(Request $request){

        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],
        ]);

        $matter = new Matter();
        $carbon = new CarbonImmutable($request->matter_change_date);
        $request->merge(['nendo' =>$carbon->subMonthsNoOverflow(3)->format('Y')]);

        $matter ->fill($request->except('_token'))->save();
        $id = $matter->id;


        $request->session()->regenerateToken();

        return  redirect($id.'/show_te');

    }
    public function save_request(Request $request){
        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],
        ]);
        $matter = new Matter();
        //新規作成後、ステータスを申請中に
        $request->merge(['status' =>2]);
        //今日の日付を申請日に
        $date=Carbon::now()->toDateTimeString();
        $request->merge(['matter_request_date' =>$date]);
        //設定日を年度に変更して追加
        $carbon = new CarbonImmutable($request->matter_change_date);
        $request->merge(['nendo' =>$carbon->subMonthsNoOverflow(3)->format('Y')]);
        //保存
        $matter ->fill($request->except('_token'))->save();
        $id = $matter->id;

        $request->session()->regenerateToken();

        return  redirect($id.'/show_te');
    }
    public function update(Request $request,$id){

        /*  print_r($_REQUEST);
         exit; */

        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],

        ]);

        $matter =matter::find($id);
        $matter->fill($request->except('_token'));

        if($matter->isDirty()&&$request->change_check==1){
            $matter->status=1;
            $matter->save();
            return  redirect($id.'/show_te');
        }elseif($matter->isDirty()){

            $request->merge(['change_check' =>1]);
            return back()
            ->withInput()
            ->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');

        }

        $request->session()->regenerateToken();
        //$id = $matter->id;
        return  redirect($id.'/show_te');
    }
    public function update_request(Request $request,$id){
        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],

        ]);

        $matter =matter::find($id);
        $matter->fill($request->except('_token'));
        $matter->status=2;
        if($matter->isDirty()&&$request->change_check==1){
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_request_date=$date;
            $matter->status=2;
            $matter->save();
            return  redirect($id.'/show_te');
        }elseif($matter->isDirty()){

            $request->merge(['change_check' =>1]);
            return back()->withInput()->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');

        }



        $request->session()->regenerateToken();
        // $id = $matter->id;
        return  redirect($id.'/show_te');
    }

    public function show_te($id){
        $matter = matter::with('tasklist')->findOrFail($id);
        //$task_count = task::where('matter_id',$id)->where('task_status',2)->count();


       //$user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail($matter->user_id);

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
            $check_userlist=$query->get('name')->all();


            //  with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);


            return view('telework.create_te',compact('user','matter','check_userlist'));


    }
}
