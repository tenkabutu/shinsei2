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
        if (Auth::check()) {
            if (Auth::user()->employee == 8565) {
                // attendance とその配下のURLはリダイレクト対象外
                if (!str_starts_with($request->path(), 'attendance')) {
                    return redirect('attendance');
                }
            }


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
                    ->where('matter_type', 2)
                    ->leftJoin('tasks', 'matters.id', '=', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', '=', 'users.id')
                    ->where('status', 2)
                    ->where('users.id', '!=', Auth::id())
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                        ->from('user_area')
                        ->whereColumn('user_area.user_id', 'users.id')
                        ->whereIn('user_area.area_id', function ($subQuery) {
                            $subQuery->select('area_id')
                            ->from('user_area')
                            ->where('user_id', Auth::id());
                        });
                    })
                    ->count('matters.id');
                    $ov_count1 = DB::table('matters')
                    ->where('matter_type', 1)
                    ->leftJoin('tasks', 'matters.id', '=', 'tasks.matter_id')
                    ->join('users', 'matters.user_id', '=', 'users.id')
                    ->where(function ($query) {
                        $query->where('status', 2)
                        ->where('users.id', '!=', Auth::id())
                        ->whereExists(function ($subQuery) {
                            $subQuery->select(DB::raw(1))
                            ->from('user_area')
                            ->whereColumn('user_area.user_id', 'users.id')
                            ->whereIn('user_area.area_id', function ($areaQuery) {
                                $areaQuery->select('area_id')
                                ->from('user_area')
                                ->where('user_id', Auth::id());
                            });
                        });
                    })
                    ->orWhere(function ($query) {
                        $query->where('task_status', 2)
                        ->where('status', '!=', 6)
                        ->where('users.id', '!=', Auth::id())
                        ->whereExists(function ($subQuery) {
                            $subQuery->select(DB::raw(1))
                            ->from('user_area')
                            ->whereColumn('user_area.user_id', 'users.id')
                            ->whereIn('user_area.area_id', function ($areaQuery) {
                                $areaQuery->select('area_id')
                                ->from('user_area')
                                ->where('user_id', Auth::id());
                            });
                        });
                    })
                    ->distinct('matters.id')
                    ->count('matters.id');

                  $te_count1 = DB::table('matters')
                  ->where('matter_type', 3)
                  ->leftJoin('tasks', 'matters.id', '=', 'tasks.matter_id')
                  ->join('users', 'matters.user_id', '=', 'users.id')
                  ->where('status', 2)
                  ->where('users.id', '!=', Auth::id())
                  ->whereExists(function ($query) {
                      $query->select(DB::raw(1))
                      ->from('user_area')
                      ->whereColumn('user_area.user_id', 'users.id')
                      ->whereIn('user_area.area_id', function ($subQuery) {
                          $subQuery->select('area_id')
                          ->from('user_area')
                          ->where('user_id', Auth::id());
                      });
                  })
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
            // 現在の月を取得
            $currentMonth = Carbon::now()->month;

            // ユーザーの hiring_lower の値を取得
            $period = Auth::user()->hiring_period;

            // 年度の開始日と終了日を計算
            if ($period == 0) {
                // 前半のユーザーの場合
                if ($currentMonth >= 4) {
                    // 現在の年度が始まったら
                    $startDate = Carbon::create($currentYear, 4, 1);
                    $endDate = Carbon::create($currentYear + 1, 3, 31);
                } else {
                    // 現在の年度がまだ始まっていない場合
                    $startDate = Carbon::create($currentYear - 1, 4, 1);
                    $endDate = Carbon::create($currentYear, 3, 31);
                }
            } elseif ($period == 1) {
                // 後半のユーザーの場合
                if ($currentMonth >= 10) {
                    // 現在の年度が始まったら
                    $startDate = Carbon::create($currentYear, 10, 1);
                    $endDate = Carbon::create($currentYear + 1, 9, 30);
                } else {
                    // 現在の年度がまだ始まっていない場合
                    $startDate = Carbon::create($currentYear - 1, 10, 1);
                    $endDate = Carbon::create($currentYear, 9, 30);
                }
            }




            // 最新の有給情報を読み込む
            $user = user::with('rest','worktype')->findOrFail(Auth::id());
            if($user->rest){


            // 消化時間を読み込む
                $used_rest_time = Matter::where([['matter_type', 2],['opt1', 4],['user_id',Auth::id()],['status','!=',6]])
                ->whereBetween('matter_change_date', [$startDate, $endDate])->sum('allotted')/60;
            //取得時間給を日数に変換
                $used_rest_day=intdiv($used_rest_time,8);


            //半休消化単位
                $used_harf_rest= Matter::where([['matter_type', 2],['user_id',Auth::id()],['status','!=',6]])->whereIn('opt1',[2,3,12])
                ->whereBetween('matter_change_date', [$startDate, $endDate])->count();


            //時間給日にち換算
                if(in_array($user->worktype->id,[8,9])){
                    $used_rest_time_byday = ceil(($used_rest_time-$user->rest->co_time)/6);
                }else{
                    $used_rest_time_byday = ceil(($used_rest_time-$user->rest->co_time)/8);
                }
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
                'startDate','endDate',
                ));
            $this->viewFactory->share('userdata', $user);
        }

        return $next($request);

    }

}
