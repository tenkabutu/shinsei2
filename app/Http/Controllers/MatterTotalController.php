<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatterTotalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function total_pa(){


        $userlist = User::leftJoin('matters', 'users.id', '=', 'matters.user_id')
        ->with('rest')
        ->select(
            'users.id','users.name','users.employee',
            DB::raw('SUM(CASE WHEN matters.opt1 = 1 THEN 1 ELSE 0 END) AS rest_day'),
            DB::raw('SUM(CASE WHEN matters.opt1 = 4 THEN matters.allotted ELSE 0 END) AS rest_time'),
            DB::raw('SUM(CASE WHEN matters.opt1 IN (2,3) THEN 1 ELSE 0 END) AS harf_rest_day')
            )
            ->groupBy('users.id','users.name','users.employee')
            ->orderby('users.employee')

            ->get();
        return view('paidleave.total_pa',compact('userlist'));

    }
    public function print_total_pa($id,$year,$month){


        $query1 = User::leftJoin('matters', 'users.id', '=', 'matters.user_id')
        ->leftjoin('rests','users.id','rests.user_id')
        ->select(
            'users.id','users.name','users.employee',
            DB::raw('SUM(CASE WHEN matters.opt1 = 1 THEN 1 ELSE 0 END) AS rest_day'),
            DB::raw('SUM(CASE WHEN matters.opt1 = 4 THEN matters.allotted ELSE 0 END) AS rest_time'),
            DB::raw('SUM(CASE WHEN matters.opt1 IN (2,3) THEN 1 ELSE 0 END) AS harf_rest_day')
            )
            ->where('users.id', $id)
            ->where('matters.status','!=', 6)
            ->groupBy('users.id','users.name','users.employee');

            if($month==0){
                $query1->where('matters.nendo', $year);
            }else{
                $query1->whereMonth('matters.matter_change_date', $month);
                $query1->whereYear('matters.matter_change_date', $year);
            }
            $user = $query1->first();


            $query = Matter::query();
            $query->WhereIn('matters.opt1',[1,2,3,4]);
            $query->where('matters.user_id', $id);
            $query->where('matters.status','!=', 6);

            $query->leftjoin('nametags as nt3', function ($join)
            {
                $join->on('matters.opt1', '=', 'nt3.tagid')
                ->where('nt3.groupid', 6);
            });
            if($month==0){
                $query->where('matters.nendo', $year);
            }else{
                $query->whereMonth('matters.matter_change_date', $month);
                $query->whereYear('matters.matter_change_date', $year);
            }
            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at','nt3.nametag as optname');
            $query->orderBy('matters.matter_change_date','asc');

            $records = $query->get();







            return view('paidleave.print_total_pa',compact('user','records'));

    }

}
