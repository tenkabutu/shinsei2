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



        $query->where('matter_type',1);
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
            $query2
            ->where('user_id',Auth::id())
            ->Where('status', 1)
            ->orwhere('task_status', 1);

        })->orwhere(function($query2){
            $query2->where('user_id',Auth::id())
            ->Where('status', 3)
            ->whereColumn('allotted', '!=', 'allotted2');

        });

            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'users.name as username', 'nt2.nametag as statusname');
            $query->orderBy('matters.id', 'desc');
            // ->select('matters.id','matters.created_at')
            // ->get();
            $records = $query->get();

            return view('dashboard', compact('records'));
    }
}
