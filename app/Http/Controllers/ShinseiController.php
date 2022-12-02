<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Matter;
use App\Models\User;

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
            $query->leftjoin('nametags as nt1',function($join){
                $join->on('matters.matter_type','=','nt1.tagid')
                ->where('nt1.groupid',4);
            });
                $query->leftjoin('nametags as nt2',function($join){
                    $join->on('matters.status','=','nt2.tagid')
                    ->where('nt2.groupid',5);
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

            $query->select('*','matters.id as matters_id','matters.created_at as matters_created_at','nt1.nametag as typename','nt2.nametag as statusname');
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
    public function matter_ruling(Request $request){

        //var_dump($request->toArray());
        //session(['ms_request'=>$request->all()]);
        //$request->sesson()->put('ms_request',$request);

        //session()->forget('mskeys');
        if($request->mode){
            $user=user::findOrFail(Auth::id());
        $query=matter::query();

        if($request->matter_type){
            $query->where('matters.matter_type',$request->matter_type);
        }

        $query->leftjoin('tasks',function($join){
            $join->on('matters.id','=','tasks.matter_id');

        });
        $query->leftjoin('users','matters.user_id','users.id');

                $query->leftjoin('nametags as nt2',function($join){
                    $join->on('matters.status','=','nt2.tagid')
                    ->where('nt2.groupid',5);
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
                    if($request->search_type==2){
                        if($user->approval==2){
                            $area_id=$user->area;
                            $query->where(function($query2) use($area_id){
                                $query2->Where('status',1)
                                ->Where('users.area', $area_id)
                                ->Where('users.id','!=',Auth::id());
                            })->orwhere(function($query2) use($area_id){
                                $query2->Where('task_status',1)
                                ->Where('users.area', $area_id)
                                ->Where('users.id','!=',Auth::id());
                            })->orwhere(function($query2) use($area_id){
                                $query2->selectRaw('sum(task_allotted) as task_total')

                                ->Where('task_status','!=',1)
                                ->Where('matters.allotted','>','task_total')
                                ->Where('users.area', $area_id)
                                ->Where('users.id','!=',Auth::id())
                                ->groupBy('tasks.matter_id');
                            });

                        }

                    }elseif($request->search_type==3){

                        if($user->approval==2){
                            $area_id=$user->area;
                            $query->where(function($query2) use($area_id){
                                $query2->Where('status',2)
                                ->Where('users.area', $area_id)
                                ->Where('users.id','!=',Auth::id());
                            })->orwhere(function($query2) use($area_id){
                                $query2->Where('task_status',2)
                                ->Where('users.area', $area_id)
                                ->Where('users.id','!=',Auth::id());
                            });

                        }
                    }elseif($request->search_type==4){
                    }elseif($request->search_type==1){


                    }else{
                        return back()->withInput();
                    }
                    if($request->user!=0){
                        $query->where('matters.user_id',$request->user);
                    }

                    if($request->month!=0){
                        $query->whereMonth('matters.created_at',$request->month);
                    }
                    if($request->day!=0){
                        $query->whereDay('matters.created_at',$request->day);
                    }



                    //$query->leftjoin('type_names','tasks.typename_id','type_names.id');
                //    $mskeys=$query->orderBy('matters.id','desc')->get(['matters.id'])->toArray();

                    $query->select('*','matters.id as matters_id','matters.created_at as matters_created_at','users.name as username','nt2.nametag as statusname');
                    $query->orderBy('matters.id','desc');
                    //->select('matters.id','matters.created_at')
                    //  ->get();
                    $records=$query

                    ->get();
                    $records2=$records->groupBy('matters.id');
                    $userlist = $this->create_userlist2( $request->user);
                    $input_data = [
                            'month' => $request->month,
                            'year' => $request->year

                    ];
                    /* echo print_r($input_data);
                    exit; */

                    return view('composite.ruling_ov', compact('records','input_data','userlist','records2'));

                    //$mskeys=$query->get(['id']);
                   // session(['mskeys'=>$mskeys]);

                    //header("Content-type: application/json; charset=UTF-8");
                    //var_dump($records->toArray());



                    //$matter ->fill($request->except('_token'))->save();


                    //event(new Registered($user));

                    //@foreach ($records as $id =>$record)
        }else{
            $userlist = $this->create_userlist();

            return view('composite.ruling_ov', compact('userlist'));
        }


    }
    public static function create_userlist(){
        $userlist = User::select('id','name')
        ->get();
        $create_userlist="";
        foreach($userlist as $us){
            $create_userlist.='<option value="'.$us->id.'">'.$us->id.':'.$us->name.'</option>';
        };
        return $create_userlist;
    }
    public static function create_userlist2($id){
        $userlist = User::select('id','name')
        ->get();
        $create_userlist="";
        foreach($userlist as $us){
            if($us->id==$id){
                $create_userlist.='<option value="'.$us->id.'" selected>'.$us->id.':'.$us->name.'</option>';
            }else{
                $create_userlist.='<option value="'.$us->id.'">'.$us->id.':'.$us->name.'</option>';
            }
        };
        return $create_userlist;
    }

}
