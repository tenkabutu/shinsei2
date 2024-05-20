<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MatterTotalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function total_pa(){

        $currentYear = Carbon::now()->year;
        // 現在の月を取得
        $currentMonth = Carbon::now()->month;
        //前期入社ユーザー4月1日～翌年3月31日までの場合
        if ($currentMonth >= 4) {
            // 現在の年度が始まったら
            $startDate1 = Carbon::create($currentYear, 4, 1);
            $endDate1 = Carbon::create($currentYear + 1, 3, 31);

        } else {
            // 現在の年度がまだ始まっていない場合
            $startDate1 = Carbon::create($currentYear - 1, 4, 1);
            $endDate1 = Carbon::create($currentYear, 3, 31);
        }
        //後期入社ユーザー10月1日～翌年9月30日までの場合
        if ($currentMonth >= 10) {
            // 現在の年度が始まったら
            $startDate2 = Carbon::create($currentYear, 10, 1);
            $endDate2 = Carbon::create($currentYear + 1, 9, 30);
        } else {
            // 現在の年度がまだ始まっていない場合
            $startDate2 = Carbon::create($currentYear - 1, 10, 1);
            $endDate2 = Carbon::create($currentYear, 9, 30);
        }


        $userlist1 = User::leftJoin('matters', function($join) use ($startDate1, $endDate1) {
            $join->on('users.id', '=', 'matters.user_id')
            ->whereBetween('matters.matter_change_date', [$startDate1, $endDate1])
            ->where('matters.status', '!=', 6);
        })
        ->with('rest')
        ->where('users.hiring_period', 0)
        ->whereRaw('(users.permissions & 16) = 16')
        ->select(
            'users.id','users.name','users.employee','users.hiring_period',
            DB::raw('SUM(CASE WHEN matters.opt1 = 1 AND matters.status != 6 THEN 1 ELSE 0 END) AS rest_day'),
            DB::raw('SUM(CASE WHEN matters.opt1 = 4 AND matters.status != 6 THEN matters.allotted ELSE 0 END) AS rest_time'),
            DB::raw('SUM(CASE WHEN matters.opt1 IN (2,3,12) AND matters.status != 6 THEN 1 ELSE 0 END) AS harf_rest_day')
            )
            ->groupBy('users.id','users.name','users.employee','users.hiring_period')
            ->orderby('users.employee')
            ->get();

        $userlist2 = User::leftJoin('matters', function($join) use ($startDate2, $endDate2) {
                $join->on('users.id', '=', 'matters.user_id')
                ->whereBetween('matters.matter_change_date', [$startDate2, $endDate2])
                ->where('matters.status', '!=', 6);
            })
            ->with('rest')
            ->where('users.hiring_period', 1)
            ->whereRaw('(users.permissions & 16) = 16')
            ->select(
                'users.id','users.name','users.employee','users.hiring_period',
                DB::raw('SUM(CASE WHEN matters.opt1 = 1 AND matters.status != 6 THEN 1 ELSE 0 END) AS rest_day'),
                DB::raw('SUM(CASE WHEN matters.opt1 = 4 AND matters.status != 6 THEN matters.allotted ELSE 0 END) AS rest_time'),
                DB::raw('SUM(CASE WHEN matters.opt1 IN (2,3,12) AND matters.status != 6 THEN 1 ELSE 0 END) AS harf_rest_day')
                )
                ->groupBy('users.id','users.name','users.employee','users.hiring_period')
                ->orderby('users.employee')
                ->get();

                $userlist = $userlist1->concat($userlist2)->sortBy('employee');
               // dd($userlist2);


                return view('paidleave.total_pa',compact('userlist','startDate1','endDate1','startDate2', 'endDate2'));

    }
    public function print_total_pa($id,$year,$month){

        $select_user=User::findOrFail($id);
        $query1 = User::leftJoin('matters', 'users.id', '=', 'matters.user_id')
        ->leftJoin('rests', function ($join) use ($month, $year,$select_user) {
            $join->on('users.employee', '=', 'rests.user_id');
            if($select_user->hiring_period==0){
                if ($month == 0) {
                    $join->where('rests.rest_year', $year);
                } else {
                    $restYear = ($month <= 4) ? ($year - 1) : $year;
                $join->where('rests.rest_year', $restYear);
                }
            }else{
                if ($month == 0) {
                    $join->where('rests.rest_year', $year);
                } else {
                    $restYear = ($month <= 9) ? ($year - 1) : $year;
                    $join->where('rests.rest_year', $restYear);
                }

            }
        })
        ->select(
            'users.id','users.name','users.employee','users.hiring_period',
            DB::raw('SUM(CASE WHEN matters.opt1 = 1 AND matters.status != 6 THEN 1 ELSE 0 END) AS rest_day'),
            DB::raw('SUM(CASE WHEN matters.opt1 = 4 AND matters.status != 6 THEN matters.allotted ELSE 0 END) AS rest_time'),
            DB::raw('SUM(CASE WHEN matters.opt1 IN (2,3,12) AND matters.status != 6 THEN 1 ELSE 0 END) AS harf_rest_day')
            )
            ->where('users.id', $id)
            ->where('matters.status','!=', 6)
            ->groupBy('users.id','users.name','users.employee','users.hiring_period');
            if($select_user->hiring_period==0){
                if($month==0){
                 $query1->where('matters.nendo', $year);
                }else{
                    $query1->whereMonth('matters.matter_change_date', $month);
                    $query1->whereYear('matters.matter_change_date', $year);
                }
            }else{
                if($month==0){
                    $query1->whereBetween('matters.matter_change_date',[$year.'-10-01',($year+1).'-09-31']);
                }else{
                    $query1->whereMonth('matters.matter_change_date', $month);
                    $query1->whereYear('matters.matter_change_date', $year);
                }

            }
            $user = $query1->first();

                $user_rest = user::leftJoin('rests', function ($join) use ($month, $year,$user,$select_user) {
                    $join->on('users.employee', '=', 'rests.user_id');
                    if ($month == 0) {
                        $join->where('rests.rest_year', $year);
                    }else if($select_user->hiring_period==0) {
                        $restYear = ($month <= 4) ? ($year - 1) : $year;
                        $join->where('rests.rest_year', $restYear);
                    }else{
                        $restYear = ($month <= 9) ? ($year - 1) : $year;
                        $join->where('rests.rest_year', $restYear);
                    }
                })->where('users.id', $id)->first();

            $query = Matter::query();
            $query->WhereIn('matters.opt1',[1,2,3,4,12]);
            $query->where('matters.user_id', $id);
            $query->where('matters.status','!=', 6);
            $query->leftjoin('nametags as nt3', function ($join)
            {
                $join->on('matters.opt1', '=', 'nt3.tagid')
                ->where('nt3.groupid', 6);
            });
            if($select_user->hiring_period==0){
                if($month==0){
                    $query->where('matters.nendo', $year);
                }else{
                    $query->whereMonth('matters.matter_change_date', $month);
                    $query->whereYear('matters.matter_change_date', $year);
                }

            }else{

                if($month==0){
                    $query->whereBetween('matters.matter_change_date',[$year.'-10-01',($year+1).'-09-31']);
                }else{
                    $query->whereMonth('matters.matter_change_date', $month);
                    $query->whereYear('matters.matter_change_date', $year);
                }


            }

            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at','nt3.nametag as optname');
            $query->orderBy('matters.matter_change_date','asc');
            $records = $query->get();

            return view('paidleave.print_total_pa',compact('select_user','user','records','user_rest','month','year'));

    }

}
