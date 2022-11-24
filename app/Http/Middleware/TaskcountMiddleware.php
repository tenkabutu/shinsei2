<?php

namespace App\Http\Middleware;

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function __construct(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function handle(Request $request, Closure $next)
    {
        if(Auth::id()){
        $user=user::findOrFail(Auth::id());

        $order_count = $user->approval;
        if($user->approval==2){
            $area_id=$user->area;


            $order_count = DB::table('matters')
            ->leftjoin('tasks','matters.id','tasks.matter_id')
            ->join('users','matters.user_id','users.id')
            ->where(function($query) use($area_id){
                $query->Where('status',2)
                ->Where('users.area', $area_id)
                ->Where('users.id','!=',Auth::id());
            })->orwhere(function($query) use($area_id){
                $query->Where('task_status',2)
                ->Where('users.area', $area_id)
                ->Where('users.id','!=',Auth::id());
            })

            ->distinct('matters.id')->count('matters.id');
        }



        $this->viewFactory->share('order_count', $order_count);
        }
        return $next($request);
    }

}
