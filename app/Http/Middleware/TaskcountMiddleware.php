<?php

namespace App\Http\Middleware;

use App\Models\Matter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Closure;

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
        $pa_count = 0;
        $ov_count = 0;
        $te_count = 0;
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

                $pa_count = DB::table('matters')
                ->where('matter_type',2)
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
                        ->Where('users.id', '!=', Auth::id());
                    })
                    ->
                    distinct('matters.id')
                    ->count('matters.id');

                 $ov_count = DB::table('matters')
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
                        ->Where('users.id', '!=', Auth::id());
                    })
                    ->
                    distinct('matters.id')
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
                $pa_count = DB::table('matters')
                    ->where('matter_type',2)
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
                        ->Where('users.area', $area_id)
                        ->Where('users.id', '!=', Auth::id());
                    })
                    ->distinct('matters.id')
                    ->count('matters.id');
            }

            // 最新の有給情報を読み込む
            $user = user::with('rest','worktype')->findOrFail(Auth::id());
            if($user->rest){


            // 消化時間を読み込む
                $used_rest_time = Matter::where([['matter_type', 2],['opt1', 4],['user_id',Auth::id()],['status','!=',6]])->sum('allotted')/60;
            //取得時間給を日数に変換
            $used_rest_day=intdiv($used_rest_time,8);
            //取得時間給を8時間で割った日数に変換
            $used_rest_time2=$used_rest_time%8;


            //半休消化単位
            $used_harf_rest= Matter::where([['matter_type', 2],['user_id',Auth::id()],['status','!=',6]])->whereIn('opt1',[2,3])->count();



            $rest_allotted_day=$user->rest_allotted_day;


            //時間給日にち換算
            $used_rest_time_byday = ceil($used_rest_time/8);
            //半休日にち換算
            $used_harf_rest_byday = ceil($used_harf_rest/2);
            //休暇日数
            $used_rest_day=Matter::where([['matter_type', 2],['user_id',Auth::id()],['status','!=',6]])->where('opt1',1)->count();

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
            $this->viewFactory->share('order_count', $order_count);
            $this->viewFactory->share('pa_count', $pa_count);
            $this->viewFactory->share('ov_count', $ov_count);
            $this->viewFactory->share('te_count', $te_count);
            $this->viewFactory->share('userdata', $user);
        }

        return $next($request);

    }

}
