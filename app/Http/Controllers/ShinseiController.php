<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matter;

class ShinseiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function matter_search(Request $request){

        //var_dump($request->toArray());
        //session(['ms_request'=>$request->all()]);
        //$request->sesson()->put('ms_request',$request);

        session()->forget('mskeys');
        $query=matter::query();

        $query->leftjoin('tasks',function($join){
            $join->on('matters.id','=','tasks.matter_id');

        });
            $query->leftjoin('nametags',function($join){
                $join->on('matters.matter_type','=','nametags.tagid')
                ->where('nametags.groupid',4);
            });

            $query->leftjoin('users as reception','matters.reception_id','reception.id');
            if($request->schooltype){
                $query->where('schools.schoolcategory',$request->schooltype);
            }
            if($request->matter_id){
                $query->where('matters.id',$request->matter_id);
            }

            if($request->typename!=0){
                $query->where('tasks.typename_id',$request->typename);
            }
            if($request->search_type1==2){
                $query->where('tasks.typename_id','!=',13);
            }
            if($request->worker!=0){
                $query->where('tasks.user_id',$request->worker);
            }
            if($request->reception!=0){
                $query->where('matters.reception_id',$request->reception);
            }

            if($request->month!=0){
                $query->whereMonth('matters.created_at',$request->month);
            }
            if($request->day!=0){
                $query->whereDay('matters.created_at',$request->day);
            }



            //$query->leftjoin('type_names','tasks.typename_id','type_names.id');
            $mskeys=$query->orderBy('matters.id','desc')->get(['matters.id'])->toArray();

            $query->select('*','matters.id as matters_id','matters.created_at as matters_created_at');
            $query->orderBy('matters.id','desc');
            //->select('matters.id','matters.created_at')
            //  ->get();
            $records=$query

            ->get();

            //$mskeys=$query->get(['id']);
            session(['mskeys'=>$mskeys]);

            //header("Content-type: application/json; charset=UTF-8");
            //var_dump($records->toArray());

            return view('composite.list', compact('records'));

            //$matter ->fill($request->except('_token'))->save();


            //event(new Registered($user));

            //@foreach ($records as $id =>$record)

    }
}
