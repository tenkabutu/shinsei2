<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Matter;
use App\Models\Nametag;
use App\Models\User;

class ShinseiController extends Controller
{

    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function matter_search (Request $request)
    {

        // var_dump($request->toArray());
        // session(['ms_request'=>$request->all()]);
        // $request->sesson()->put('ms_request',$request);

        // session()->forget('mskeys');
        if ($request->mode) {
            $query = matter::query();

            $query->leftjoin('tasks', function ($join)
            {
                $join->on('matters.id', '=', 'tasks.matter_id');
            });
            $query->leftjoin('users', 'matters.user_id', 'users.id');
            $query->leftjoin('users as reception','matters.reception_id','reception.id');
            $query->leftjoin('nametags as nt1', function ($join)
            {
                $join->on('matters.matter_type', '=', 'nt1.tagid')
                    ->where('nt1.groupid', 4);
            });
            $query->leftjoin('nametags as nt2', function ($join)
            {
                $join->on('matters.status', '=', 'nt2.tagid')
                    ->where('nt2.groupid', 5);
            });
            if ($request->matter_id) {
                $query->where('matters.id', $request->matter_id);
            }

            if ($request->typename != 0) {
                $query->where('tasks.typename_id', $request->typename);
            }
            if ($request->search_type == 2) {


                $query->where(function ($query2)
                    {
                        $query2->Where('status', 1)
                        ->Where('users.id', '=', Auth::id());
                    })
                    ->orwhere(function ($query2){
                        $query2->Where('task_status', 1)
                        ->Where('users.id', Auth::id());

                    })
                    ->orwhere(function ($query2){

                        $query2->whereColumn('allotted', '!=', 'allotted2')
                        ->where('matter_type',1)
                        ->Where('users.id', Auth::id());

                    });
            } elseif ($request->search_type == 3) {
                $query->where(function ($query2)
                {
                    $query2->Where('status', 2)
                        ->Where('users.id', '=', Auth::id());
                })
                    ->orwhere(function ($query2)
                {
                    $query2->Where('task_status', 2)
                        ->Where('users.id', Auth::id());
                });
            } elseif ($request->search_type == 4) {
                $query->Where('status', 3)
                    ->where('task_status', 3)
                    ->Where('users.id', Auth::id())
                    ->whereColumn('allotted', 'allotted2');
            } elseif ($request->search_type == 1) {
                $query->Where('users.id', '=', Auth::id())
                    ->Where('status', '!=', 6);
            } else {
                return back()->withInput();
            }

            if ($request->month != 0) {
                $query->whereMonth('matters.matter_change_date', $request->month);
            }
            if ($request->day != 0) {
                $query->whereDay('matters.matter_change_date', $request->day);
            }
            $mskeys = $query->orderBy('matters.id', 'desc')
                ->get([
                    'matters.id'
            ])
                ->toArray();

            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'nt1.nametag as typename', 'nt2.nametag as statusname');
            $query->orderBy('matters.id', 'desc');
            // ->select('matters.id','matters.created_at')
            // ->get();
            $records = $query->
            get();

            // $mskeys=$query->get(['id']);
            session([
                    'mskeys' => $mskeys
            ]);

            // header("Content-type: application/json; charset=UTF-8");
            // var_dump($records->toArray());

            return view('composite.list', compact('records'));
        } else {
            return view('composite.list');
        }

        // $matter ->fill($request->except('_token'))->save();

        // event(new Registered($user));
    }
    public function matter_search2 (Request $request,$type)
    {

        if ($request->mode) {
            $query = matter::query();

            $query->where('matters.matter_type',$type);
            $query->leftjoin('tasks','matters.id', '=', 'tasks.matter_id');


            $query->leftjoin('users', 'matters.user_id', 'users.id');
            $query->leftjoin('users as reception','matters.reception_id','reception.id');
            $query->leftjoin('nametags as nt1', function ($join)
            {
                $join->on('matters.opt1', '=', 'nt1.tagid')
                ->where('nt1.groupid', 6);
            });
            $query->leftjoin('nametags as nt2', function ($join)
            {
                $join->on('matters.status', '=', 'nt2.tagid')
                ->where('nt2.groupid', 5);
            });
            if ($request->matter_id) {
                $query->where('matters.id', $request->matter_id);
            }

            if ($request->search_type == 2) {


                $query->where(function ($query2)
                {
                    $query2->Where('status', 1)
                    ->Where('users.id', '=', Auth::id());
                })
                ->orwhere(function ($query2){
                    $query2->Where('task_status', 1)
                    ->Where('users.id', Auth::id());

                })
                ->orwhere(function ($query2){

                    $query2->whereColumn('allotted', '!=', 'allotted2')
                    ->where('matter_type',1)
                    ->Where('users.id', Auth::id());

                });
            } elseif ($request->search_type == 3) {
                $query->where(function ($query2)
                {
                    $query2->Where('status', 2)
                    ->Where('users.id', '=', Auth::id());
                })
                ->orwhere(function ($query2)
                {
                    $query2->Where('task_status', 2)
                    ->Where('users.id', Auth::id());
                });
            } elseif ($request->search_type == 4) {
                $query->Where('status', 3)
                ->where('task_status', 3)
                ->Where('users.id', Auth::id())
                ->whereColumn('allotted', 'allotted2');
            } elseif ($request->search_type == 1) {
                $query->Where('users.id', '=', Auth::id())
                ->Where('status', '!=', 6);
            } else {
                return back()->withInput();
            }

            if ($request->month != 0) {
                $query->whereMonth('matters.matter_change_date', $request->month);
            }
            if ($request->day != 0) {
                $query->whereDay('matters.matter_change_date', $request->day);
            }

            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'reception.name as username2', 'nt1.nametag as typename', 'nt2.nametag as statusname');
            $query->orderBy('matters.id', 'desc');

            $records = $query->get();

            return view('composite.list', compact('records'));
        } else {


            $query = matter::query();

            $query->where('matters.matter_type',$type);
            $query->leftjoin('tasks','matters.id', '=', 'tasks.matter_id');


            $query->leftjoin('users', 'matters.user_id', 'users.id');
            $query->leftjoin('users as reception','matters.reception_id','reception.id');
            $query->leftjoin('nametags as nt1', function ($join)
            {
                $join->on('matters.opt1', '=', 'nt1.tagid')
                ->where('nt1.groupid', 6);
            });
            $query->leftjoin('nametags as nt2', function ($join)
            {
                $join->on('matters.status', '=', 'nt2.tagid')
                ->where('nt2.groupid', 5);
            });
            if ($request->matter_id) {
                $query->where('matters.id', $request->matter_id);
            }


                $query->Where('users.id', '=', Auth::id())
                ->Where('status', '!=', 6);


            if ($request->month != 0) {
                $query->whereMonth('matters.matter_change_date', $request->month);
            }


            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'reception.name as username2', 'nt1.nametag as typename', 'nt2.nametag as statusname');
            $query->orderBy('matters.id', 'desc');

            $records = $query->get();
            $search_type=1;



            return view('composite.list',compact('records','search_type'));
        }

        // $matter ->fill($request->except('_token'))->save();

        // event(new Registered($user));
    }
    public function matter_ruling (Request $request)
    {
        //var_dump($request->toArray());
        if ($request->mode) {
            $user = user::findOrFail(Auth::id());
            $query = matter::query();
            $matter_type = 0;

            if ($request->matter_type) {
                $matter_type = $request->matter_type;
                $query->where('matter_type', $matter_type);
            }

            $query->leftjoin('tasks', function ($join)
            {
                $join->on('matters.id', '=', 'tasks.matter_id');
            });
            $query->leftjoin('users', 'matters.user_id', 'users.id');
            $query->leftjoin('users as reception','matters.reception_id','reception.id');
            $query->leftjoin('nametags as nt2', function ($join)
            {
                $join->on('matters.status', '=', 'nt2.tagid')
                    ->where('nt2.groupid', 5);
            });


            if ($request->search_type) {
                if ($request->search_type == 1) {
                    $query->Where('status', '!=', 6);

                }elseif ($request->search_type == 2) {

                    $area_id = $user->area;
                    if($matter_type==1){
                        $query->where(function ($query2){
                            $query2->Where('status', 1)
                            ->orwhere('task_status', 1);
                        })->orwhere(function($query2){
                            $query2->Where('status', 3)
                            ->where('matter_type', 1)
                            ->whereColumn('allotted', '!=', 'allotted2');

                        });

                    }else{
                        $query->Where('status', 1);
                    }
                } elseif ($request->search_type == 3) {

                    $area_id = $user->area;
                    $query->where(function ($query2) use ( $area_id)
                    {
                        $query2->Where('status', 2)
                            ->Where('users.area', $area_id)
                            ->Where('users.id', '!=', Auth::id());
                    })
                        ->orwhere(function ($query2) use ( $area_id)
                    {
                        $query2->Where('task_status', 2)
                            ->Where('users.area', $area_id)
                            ->Where('users.id', '!=', Auth::id());
                    });
                } elseif ($request->search_type == 4) {
                    if($matter_type==1){
                    $query->Where('status', 3)
                        ->where('task_status', 3)
                        ->whereColumn('allotted', 'allotted2');
                    }else{
                        $query->Where('status', 3);
                    }
                }
            } else {}
            if ($request->user != 0) {
                $query->where('matters.user_id', $request->user);
            }

            if ($request->month != 0) {
                $query->whereMonth('matters.matter_change_date', $request->month);
            }
            if ($request->day != 0) {
                $query->whereDay('matters.matter_change_date', $request->day);
            }

            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'users.name as username', 'reception.name as username2', 'nt2.nametag as statusname');
            $query->orderBy('matters.id', 'desc');
            // ->select('matters.id','matters.created_at')
            // ->get();
            $records = $query->get();
            $records2 = $records->groupBy('matters.id');
            $userlist = $this->create_userlist2($request->user);
            $input_data = [
                    'month' => $request->month,
                    'year' => $request->year,
                    'matter_type' => $request->matter_type,
                    'search_type' => $request->search_type
            ];
            /*
             * echo print_r($input_data);
             * exit;
             */

            return view('composite.ruling_ov', compact('records', 'input_data', 'userlist', 'records2'));
        } else {
            $userlist = $this->create_userlist();

            return view('composite.ruling_ov', compact('userlist'));
        }
    }
    public function matter_ruling2 (Request $request,$type)
    {
        //publicのあとに数字が入っていればこっち
        //var_dump($request->toArray());
        $type2=$type;
        if($type<7&&$type>3){
            $type2=$type-3;
        }
            $userlist = $this->create_userlist2($request->user);
            $arealist = $this->create_arealist();
            $search_type=$request->search_type;

            $user = user::findOrFail(Auth::id());
            $query = matter::query();
            $query->where('matters.matter_type',$type2);



            $query->leftjoin('tasks', function ($join)
            {
                $join->on('matters.id', '=', 'tasks.matter_id');
            });
            $query->leftjoin('users', 'matters.user_id', 'users.id');
            $query->leftjoin('nametags as nt3', function ($join)
            {
                $join->on('matters.opt1', '=', 'nt3.tagid')
                ->where('nt3.groupid', 6);
            });
            if(isset($request->matter_opt)){
                $opt = $request->matter_opt;
                if($opt==1){
                    $query->WhereIn('opt1',[1,2,3,4]);
                }elseif($opt==2){
                    $query->WhereIn('opt1',[9,10,11]);
                }elseif($opt==3){
                    $query->Where('opt1',7);
                }elseif($opt==4){
                    $query->Where('opt1',8);
                }
            }
            $query->leftjoin('nametags as nt4', function ($join)
            {
                $join->on('users.area', '=', 'nt4.tagid')
                ->where('nt4.groupid', 3);
            });
            $query->leftjoin('users as reception','matters.reception_id','reception.id');
            $query->leftjoin('nametags as nt2', function ($join)
            {
                $join->on('matters.status', '=', 'nt2.tagid')
                ->where('nt2.groupid', 5);
            });


            if ($request->search_type) {

                if ($request->search_type == 1) {
                    $query->Where('status', '!=', 6);

                }elseif ($request->search_type == 2) {

                    $area_id = $user->area;
                    if($type2==1){
                        $query->where(function ($query2){
                            $query2->Where('status', 1)
                            ->orwhere('task_status', 1);
                        })->orwhere(function($query2){
                            $query2->Where('status', 3)
                            ->where('matter_type', 1)
                            ->where('opt1',7)
                            ->whereColumn('allotted', '!=', 'allotted2');

                        });

                    }else{
                        $query->Where('status', 1);
                }
            } elseif ($request->search_type == 3) {

                $area_id = $user->area;
                if($type2==7){
                    $query->where('status', 2);
                    //dd($request);

                }elseif ($user->approval == 1) {
                    $query->where(function ($query) use ($type2) {
                        $query->where('matters.matter_type', '=', $type2)
                        ->where(function ($query) {
                            $query->where('status', '=', 2)
                            ->where('users.id', '!=', Auth::id());
                        })
                        ->orWhere(function ($query) {
                            $query->where('task_status', '=', 2)
                            ->where('users.id', '!=', Auth::id());
                        });
                    });
                }elseif ($user->approval == 2) {
                    $query->where(function ($query) use ($type2,$area_id) {
                        $query->where('matters.matter_type', '=', $type2)
                        ->Where('users.area', $area_id)
                        ->where(function ($query) {
                            $query->where('status', '=', 2)
                            ->where('users.id', '!=', Auth::id());
                        })
                        ->orWhere(function ($query) {
                            $query->where('task_status', '=', 2)
                            ->where('users.id', '!=', Auth::id());
                        });
                    });



                }else{
                    return view('composite.ruling_ov', compact( 'userlist','type'));
                }



                } elseif ($request->search_type == 4) {
                    if($type2==1){
                        $query->Where('status', 3)
                        ->where('task_status', 3)
                        ->whereColumn('allotted', 'allotted2');
                    }else{
                        $query->Where('status', 3);
                    }
                }
//             } else {
//                 var_dump('tes');


            /*     $area_id = $user->area;
                $query->where(function ($query2) use ( $area_id)
                {
                    $query2->Where('status', 2)
                    ->Where('users.area', $area_id)
                    ->Where('users.id', '!=', Auth::id());
                })
                ->orwhere(function ($query2) use ( $area_id)
                {
                    $query2->Where('task_status', 2)
                    ->Where('users.area', $area_id)
                    ->Where('users.id', '!=', Auth::id());
                }); */
           /*  } */
                if ($request->user != null && $request->user != 0) {
                $query->where('matters.user_id', $request->user);
            }
            if ($request->area != null && $request->area != 100) {
                $query->where('users.area', $request->area);
            }

            if ($request->month != 0) {
                $query->whereMonth('matters.matter_change_date', $request->month);
            }
            if ($request->year != 0&&$request->month != 0) {
                $query->whereYear('matters.matter_change_date', $request->year);
            }elseif($request->year != 0){

                $query->where('matters.nendo',$request->year);
            }
            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'users.name as username', 'users.employee as employee','reception.name as username2','nt2.nametag as statusname','nt4.nametag as area','nt3.nametag as optname');

           $query->orderByRaw('users.employee asc,matters.id desc');
            //$query->orderBy('matters.id', 'desc');
            // ->select('matters.id','matters.created_at')
            // ->get();
            $records = $query->get();

            $records2 = $records->groupBy('matters.id');

            $input_data = [
                    'month' => $request->month,
                    'year' => $request->year,
                    'matter_type' => $type,
                    'search_type' => $search_type
            ];

            /*
             * echo print_r($input_data);
             * exit;
             */

            return view('composite.ruling_ov', compact('records', 'input_data', 'userlist','type','arealist'));
          }else {
              return view('composite.ruling_ov', compact( 'userlist','type','arealist'));
          }

    }
    public function user_rest (Request $request,$type)
    {

        $vacationTimeByUser = DB::table('users')
        ->join('matters', 'users.id', '=', 'matters.user_id')
        ->select('users.name', 'matters.matter_type', DB::raw('SUM(vacations.duration) as total_duration'))
        ->groupBy('users.name', 'matters.matter_type')
        ->get();

        // 結果を表示する
        foreach ($vacationTimeByUser as $vacation) {
            echo $vacation->name . ' ' . $vacation->type . ' ' . $vacation->total_duration . '時間' . PHP_EOL;
        }

    }
//     public function matter_ruling2 (Request $request,$type)
//     {
//         //var_dump($request->toArray());
//         if ($request->mode) {
//             var_dump($request->toArray());
//             $user = user::findOrFail(Auth::id());
//             $query = matter::query();
//             $query->where('matters.matter_type',$type);



//             $query->leftjoin('tasks', function ($join)
//             {
//                 $join->on('matters.id', '=', 'tasks.matter_id');
//             });
//             $query->leftjoin('users', 'matters.user_id', 'users.id');
//             $query->leftjoin('users as reception','matters.reception_id','reception.id');
//             $query->leftjoin('nametags as nt2', function ($join)
//             {
//                 $join->on('matters.status', '=', 'nt2.tagid')
//                 ->where('nt2.groupid', 5);
//             });


//             if ($request->search_type) {
//                 if ($request->search_type == 1) {
//                     $query->Where('status', '!=', 6);

//                 }elseif ($request->search_type == 2) {

//                     $area_id = $user->area;
//                     if($type==1){
//                         $query->where(function ($query2){
//                             $query2->Where('status', 1)
//                             ->orwhere('task_status', 1);
//                         })->orwhere(function($query2){
//                             $query2->Where('status', 3)
//                             ->where('matter_type', 1)
//                             ->whereColumn('allotted', '!=', 'allotted2');

//                         });

//                     }else{
//                         $query->Where('status', 1);
//                     }
//                 } elseif ($request->search_type == 3) {

//                     $area_id = $user->area;
//                     $query->where(function ($query2) use ( $area_id)
//                     {
//                         $query2->Where('status', 2)
//                         ->Where('users.area', $area_id)
//                         ->Where('users.id', '!=', Auth::id());
//                     })
//                     ->orwhere(function ($query2) use ( $area_id)
//                     {
//                         $query2->Where('task_status', 2)
//                         ->Where('users.area', $area_id)
//                         ->Where('users.id', '!=', Auth::id());
//                     });
//                 } elseif ($request->search_type == 4) {
//                     if($type==1){
//                         $query->Where('status', 3)
//                         ->where('task_status', 3)
//                         ->whereColumn('allotted', 'allotted2');
//                     }else{
//                         $query->Where('status', 3);
//                     }
//                 }
//             } else {}
//             if ($request->user != 0) {
//                 $query->where('matters.user_id', $request->user);
//             }

//             if ($request->month != 0) {
//                 $query->whereMonth('matters.matter_change_date', $request->month);
//             }
//             $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'users.name as username', 'reception.name as username2', 'nt2.nametag as statusname');
//             $query->orderBy('matters.id', 'desc');
//             // ->select('matters.id','matters.created_at')
//             // ->get();
//             $records = $query->get();
//             $records2 = $records->groupBy('matters.id');
//             $userlist = $this->create_userlist2($request->user);
//             $input_data = [
//                     'month' => $request->month,
//                     'year' => $request->year,
//                     'matter_type' => $request->matter_type,
//                     'search_type' => $request->search_type
//             ];
//             /*
//              * echo print_r($input_data);
//              * exit;
//              */

//             return view('composite.ruling_ov', compact('records', 'input_data', 'userlist', 'records2'));
//         } else {
//             $userlist = $this->create_userlist();

//             return view('composite.ruling_ov', compact('userlist'));
//         }
//     }

    public static function create_userlist ()
    {
        $userlist = User::select('id','employee', 'name')
            ->whereRaw('(permissions & 16) = 16')->orderby('employee','asc')->get();
        $create_userlist = "";
        foreach ($userlist as $us) {
            $create_userlist .= '<option value="' . $us->id . '">' . $us->employee . ':' . $us->name . '</option>';
        }
        ;
        return $create_userlist;
    }
    public static function create_arealist ()
    {
        $arealist = Nametag::where('groupid','3')->select('tagid', 'nametag')->orderby('tagid','asc')->get();
        $create_arealist = "";
        foreach ($arealist as $us) {
            $create_arealist .= '<option value="' . $us->tagid . '">'. $us->nametag . '</option>';
        }
        ;
        return $create_arealist;
    }

    public static function create_userlist2 ($id)
    {
        $userlist = User::select('id','employee', 'name')->whereRaw('(permissions & 16) = 16')
            ->orderby('employee','asc')->get();
        $create_userlist = "";
        foreach ($userlist as $us) {
            if ($us->id == $id) {
                $create_userlist .= '<option value="' . $us->id . '" selected>' . $us->employee . ':' . $us->name . '</option>';
            } else {
                $create_userlist .= '<option value="' . $us->id . '">' . $us->employee . ':' . $us->name . '</option>';
            }
        }
        ;
        return $create_userlist;
    }
}
