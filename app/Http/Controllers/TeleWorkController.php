<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Matter;

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
        $matter ->fill($request->except('_token'))->save();
        $id = $matter->id;


        $request->session()->regenerateToken();

        return  redirect($id.'/show_te');

    }

    public function show_te($id){

        $matter = matter::with('tasklist')->findOrFail($id);
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


            return view('telework.create_te',compact('user','matter','check_userlist'));


    }
}
