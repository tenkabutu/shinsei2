<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaidLeaveController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){
        $user=User::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);
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

            return view('paidleave.create_pa',compact('user','check_userlist'));

    }
    public function save(Request $request){

        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],
        ]);

        $matter = new matter();
        $matter ->fill($request->except('_token'))->save();
        $id = $matter->id;


        $request->session()->regenerateToken();

        return  redirect($id.'/show_pa');

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
            return  redirect($id.'/rewrite_ov');
        }elseif($matter->isDirty()){

            $request->merge(['change_check' =>1]);
            return back()
            ->withInput()
            ->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');

        }

        $request->session()->regenerateToken();
        //$id = $matter->id;
        return  redirect($id.'/show_pa');
    }
    public function show_pa($id){

        $matter = Matter::with('tasklist')->findOrFail($id);
        //$task_count = task::where('matter_id',$id)->where('task_status',2)->count();


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


            //  with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);


            return view('paidleave.create_pa',compact('user','matter','check_userlist'));


    }
}
