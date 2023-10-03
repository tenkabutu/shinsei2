<?php

namespace App\Http\Middleware;

use App\Models\Matter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Closure;
use Carbon\Carbon;

class TaskcountMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param
     *            \Closure(\Illuminate\Http\Request):
     *            (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)
     *            $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __construct (Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function handle (Request $request, Closure $next)
    {

        // $user=user::where('id',Auth::id());
        $order_count = 0;
        $pa_count1 = 0;
        $ov_count1 = 0;
        $te_count1 = 0;
        $pa_count2 = 0;
        $ov_count2 = 0;
        $te_count2 = 0;
        $pu_count1=0;
        if (Auth::id()) {


            //承認権限がすべてかエリアか
            if (Auth::user()->approval == 1) {

                $order_count = DB::table('matters')->leftjoin('tasks', 'matters.id', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', 'users.id')
                    ->where(function ($query)
                {
                    $query->Where('status', 2)
                        ->Where('users.id', '!=', Auth::id());
                })
                    ->orwhere(function ($query)
                {
                    $query->Where('task_status', 2)
                        ->Where('users.id', '!=', Auth::id());
                })
                    ->
                distinct('matters.id')
                    ->count('matters.id');

                $pa_count1 = DB::table('matters')
                ->where('matter_type',2)
                    ->join('users', 'matters.user_id', 'users.id')
                    ->Where('status', 2)
                    ->Where('users.id', '!=', Auth::id())

                    ->count('matters.id');

                $te_count1 = DB::table('matters')
                    ->where('matter_type',3)
                    ->join('users', 'matters.user_id', 'users.id')
                    ->Where('status', 2)
                    ->Where('users.id', '!=', Auth::id())
                    ->count('matters.id');

                 $ov_count1 = DB::table('matters')
                    ->where('matter_type',1)
                    ->leftjoin('tasks', 'matters.id', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', 'users.id')
                    ->where(function ($query)
                    {
                        $query->Where('status', 2)
                        ->Where('users.id', '!=', Auth::id());
                    })
                    ->orwhere(function ($query)
                    {
                        $query->Where('task_status', 2)
                        ->Where('status', '!=',6)
                        ->Where('users.id', '!=', Auth::id());
                    })
                    ->distinct('matters.id')
                    ->count('matters.id');
            } elseif (Auth::user()->approval == 2) {
                $area_id = Auth::user()->area;

                $order_count = DB::table('matters')->leftjoin('tasks', 'matters.id', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', 'users.id')
                    ->where(function ($query) use ( $area_id)
                {
                    $query->Where('status', 2)
                        ->Where('users.area', $area_id)
                        ->Where('users.id', '!=', Auth::id());
                })
                    ->orwhere(function ($query) use ( $area_id)
                {
                    $query->Where('task_status', 2)
                        ->Where('users.area', $area_id)
                        ->Where('users.id', '!=', Auth::id());
                })
                    ->distinct('matters.id')
                    ->count('matters.id');
                $pa_count1 = DB::table('matters')
                    ->where('matter_type',2)
                    ->leftjoin('tasks', 'matters.id', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', 'users.id')
                    ->Where('status', 2)
                    ->Where('users.area', $area_id)
                     ->Where('users.id', '!=', Auth::id())

                    ->count('matters.id');
                 $ov_count1 = DB::table('matters')
                    ->where('matter_type',1)
                    ->leftjoin('tasks', 'matters.id', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', 'users.id')
                    ->where(function ($query) use ( $area_id)
                    {
                        $query->Where('status', 2)
                        ->Where('users.area', $area_id)
                        ->Where('users.id', '!=', Auth::id());
                    })
                    ->orwhere(function ($query) use ( $area_id)
                    {
                        $query->Where('task_status', 2)
                        ->Where('status', '!=',6)
                        ->Where('users.area', $area_id)
                        ->Where('users.id', '!=', Auth::id());
                    })
                    ->distinct('matters.id')
                    ->count('matters.id');

                  $te_count1 = DB::table('matters')
                    ->where('matter_type',3)
                    ->leftjoin('tasks', 'matters.id', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', 'users.id')
                    ->Where('status', 2)
                        ->Where('users.area', $area_id)
                        ->Where('users.id', '!=', Auth::id())

                    ->count('matters.id');
            }
/*
            $pa_count2 = DB::table('matters')
            ->where('matter_type',2)
            ->where('user_id',Auth::id())
            ->Where('status', 2)
            ->count('matters.id');
            $pa_count3 = DB::table('matters')
            ->where('matter_type',2)
            ->where('user_id',Auth::id())
            ->Where('status', 5)
            ->count('matters.id');
            $pu_count2 = DB::table('matters')
            ->where('matter_type',7)
            ->where('user_id',Auth::id())
            ->Where('status', 2)
            ->count('matters.id');
            $pu_count3 = DB::table('matters')
            ->where('matter_type',7)
            ->where('user_id',Auth::id())
            ->Where('status', 5)
            ->count('matters.id');
            $te_count2 = DB::table('matters')
            ->where('matter_type',3)
            ->where('user_id',Auth::id())
            ->Where('status', 2)
            ->count('matters.id');
            $te_count3 = DB::table('matters')
            ->where('matter_type',3)
            ->where('user_id',Auth::id())
            ->Where('status', 5)
            ->count('matters.id'); */
            $authId = Auth::id();
            $pu_count1=Matter::where('matter_type', 7)
            ->where('status', 2)
            ->count();

            $countQuery = DB::table('matters')
            ->where('user_id', $authId)
            ->whereIn('matter_type', [2, 7, 3])
            ->whereIn('status', [2, 5])
            ->select('matter_type', 'status', DB::raw('COUNT(id) as count'))
            ->groupBy('matter_type', 'status')
            ->get();

            $counts = [];

            foreach ($countQuery as $row) {
                $counts[$row->matter_type][$row->status] = $row->count;
            }

            $pa_count2 = $counts[2][2] ?? 0;
            $pa_count3 = $counts[2][5] ?? 0;
            $pu_count2 = $counts[7][2] ?? 0;
            $pu_count3 = $counts[7][5] ?? 0;
            $te_count2 = $counts[3][2] ?? 0;
            $te_count3 = $counts[3][5] ?? 0;

            $ov_count2 = DB::table('matters')
            ->where('matter_type',1)
            ->leftjoin('tasks', 'matters.id', 'tasks.matter_id')
            ->where(function ($query){
                $query->Where('status', 2)
                ->where('user_id',Auth::id());
            })
            ->orwhere(function ($query){
                $query->Where('task_status', 2)
                ->Where('status','!=', 5)
                ->where('user_id',Auth::id());
            })
            ->distinct('matters.id')
            ->count('matters.id');

            $ov_count3 = DB::table('matters')
            ->where('matter_type',1)
            ->Where('status', 5)
            ->where('user_id',Auth::id())
            ->count('matters.id');


            // 現在の年を取得
            $currentYear = Carbon::now()->year;

            // 今年度の開始日（4月1日）を設定
            $startDate = Carbon::create($currentYear, 4, 1);

            // 今年度の終了日（翌年の3月31日）を設定
            $endDate = Carbon::create($currentYear + 1, 3, 31);



            // 最新の有給情報を読み込む
            $user = user::with('rest','worktype')->findOrFail(Auth::id());
            if($user->rest){


            // 消化時間を読み込む
                $used_rest_time = Matter::where([['matter_type', 2],['opt1', 4],['user_id',Auth::id()],['status','!=',6]])
                ->whereBetween('matter_change_date', [$startDate, $endDate])->sum('allotted')/60;
            //取得時間給を日数に変換
                $used_rest_day=intdiv($used_rest_time,8);


            //半休消化単位
                $used_harf_rest= Matter::where([['matter_type', 2],['user_id',Auth::id()],['status','!=',6]])->whereIn('opt1',[2,3])
                ->whereBetween('matter_change_date', [$startDate, $endDate])->count();


            //時間給日にち換算
                $used_rest_time_byday = ceil(($used_rest_time-$user->rest->co_time)/8);
            //半休日にち換算
                $used_harf_rest_byday = ($used_harf_rest-$user->rest->co_harf_rest)/2;
            //休暇日数
                $used_rest_day=Matter::where([['matter_type', 2],['user_id',Auth::id()],['status','!=',6]])->where('opt1',1)
                ->whereBetween('matter_change_date', [$startDate, $endDate])->count();

            $residue_co_day=$user->rest->co_day-$used_rest_time_byday-$used_harf_rest_byday-$used_rest_day;

            $residue_rest_day =$user->rest->rest_allotted_day+$residue_co_day;



            // header("Content-type: application/json; charset=UTF-8");
            // echo $rest_day_list;
            // exit();
            //付与休憩時間から時間給を引いて60分
           // $residue_day = intdiv($user->rest->rest_allotted-$used_rest_time,480);



            $this->viewFactory->share('rest_time', $used_rest_time);
            $this->viewFactory->share('used_rest_day', $used_rest_day);
            $this->viewFactory->share('used_rest_time', $used_rest_time);
            $this->viewFactory->share('used_harf_rest', $used_harf_rest);


            $this->viewFactory->share('residue_rest_day', $residue_rest_day);
            $this->viewFactory->share('residue_co_day', $residue_co_day);

            };


            $this->viewFactory->share(compact(
                'order_count','pa_count1',
                'ov_count1','pu_count1','te_count1',
                'pa_count2', 'ov_count2',
                'te_count2', 'pa_count3',
                'ov_count3', 'te_count3',
                'pu_count2','pu_count3',
                ));
            $this->viewFactory->share('userdata', $user);
        }

        return $next($request);

    }

}
