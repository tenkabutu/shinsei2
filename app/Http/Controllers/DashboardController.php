<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Matter;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function show_dash(){

        //$user = user::findOrFail(Auth::id());
        $query = matter::query();

        $query->where('user_id',Auth::id());


        $query->leftjoin('tasks', 'matters.id', 'tasks.matter_id');

        $query->join('users', 'matters.user_id', 'users.id');
        //$query->leftjoin('users as reception','matters.reception_id','reception.id');
        $query->leftjoin('nametags as nt2', function ($join)
        {
            $join->on('matters.status', '=', 'nt2.tagid')
            ->where('nt2.groupid', 5);
        });
        $query->where(function ($query2){
            $query2->where('matter_type',1)->where('user_id',Auth::id())
            ->Where('status', 1)
            ->orwhere('task_status', 1);

        })->orwhere(function($query2){
            $query2->where('matter_type',1)->where('user_id',Auth::id())
            ->Where('status', 3)
            ->whereColumn('allotted', '!=', 'allotted2');

        });

            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'users.name as username', 'nt2.nametag as statusname');
            $query->orderBy('matters.id', 'desc');
            // ->select('matters.id','matters.created_at')
            // ->get();
            $records = $query->get();
            $park_list = matter::with('user')->where('matter_type',8)->orderby('matters.id', 'asc')->get();

            return view('dashboard', compact('records','park_list'));
    }
    public function car_park(Request $request){

        $matter = Matter::findOrFail($request->id);
       // $userId = $request->input('user_id');
        if($matter->user_id==0){
            if($request->user_id!=0){
                $matter->user_id = $request->user_id;
                $matter->update();
                return response()->json(['status' => 'success']);
            }else{
                return response()->json(['status' => 'error', 'message' => '他のユーザーが解除処理を行いました。']);
            }

        }elseif($matter->user_id!=0){
            if($request->user_id==0){
                $matter->user_id = $request->user_id;
                $matter->update();
                return response()->json(['status' => 'success']);
            }else{
                return response()->json(['status' => 'error', 'message' => '先に駐車した方がいます、ページを更新してください。']);
            }
        }
       // return  redirect('dashboard');



    }
}
