<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Matter;
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

            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'nt1.nametag as typename', 'nt2.nametag as statusname');
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


                $query->Where('users.id', '=', Auth::id())
                ->Where('status', '!=', 6);


            if ($request->month != 0) {
                $query->whereMonth('matters.matter_change_date', $request->month);
            }


            $query->select('*', 'matters.id as matters_id', 'matters.created_at as matters_created_at', 'nt1.nametag as typename', 'nt2.nametag as statusname');
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
        //var_dump($request->toArray());

            $user = user::findOrFail(Auth::id());
            $query = matter::query();
            $query->where('matters.matter_type',$type);



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
                    if($type==1){
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
                    if($type==1){
                        $query->Where('status', 3)
                        ->where('task_status', 3)
                        ->whereColumn('allotted', 'allotted2');
                    }else{
                        $query->Where('status', 3);
                    }
                }
            } else {

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
            }
            if ($request->user != 0) {
                $query->where('matters.user_id', $request->user);
            }

            if ($request->month != 0) {
                $query->whereMonth('matters.matter_change_date', $request->month);
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
                    'matter_type' => $type,
                    'search_type' => $request->search_type
            ];

            /*
             * echo print_r($input_data);
             * exit;
             */

            return view('composite.ruling_ov', compact('records', 'input_data', 'userlist', 'records2'));

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
        $userlist = User::select('id', 'name')->get();
        $create_userlist = "";
        foreach ($userlist as $us) {
            $create_userlist .= '<option value="' . $us->id . '">' . $us->id . ':' . $us->name . '</option>';
        }
        ;
        return $create_userlist;
    }

    public static function create_userlist2 ($id)
    {
        $userlist = User::select('id', 'name')->get();
        $create_userlist = "";
        foreach ($userlist as $us) {
            if ($us->id == $id) {
                $create_userlist .= '<option value="' . $us->id . '" selected>' . $us->id . ':' . $us->name . '</option>';
            } else {
                $create_userlist .= '<option value="' . $us->id . '">' . $us->id . ':' . $us->name . '</option>';
            }
        }
        ;
        return $create_userlist;
    }
}
