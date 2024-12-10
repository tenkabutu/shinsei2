<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AreaData;
use App\Models\User;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function userlist(){


        $userlist = user::with('areas','roletag','approvaltag','areatag','worktype')->orderBy('employee','asc')->get();
        $areas = AreaData::all();
        return view('user.userlist',compact('userlist','areas'));

    }
    public function user_change(Request $request){
       // $request->headers->set('Accept','application/json');
        //print_r($request->toArray());

        $user=user::find($request->id);
        $user->update($request->except('_token', 'areas'));  // 'areas' は担当エリアのフィールド名

        // 担当エリアの更新 (担当エリアが選択されている場合)
        if ($request->has('areas')) {
            // 複数選択されたエリアを同期
            $user->areas()->sync($request->areas);
        }


        header("Content-type: application/json; charset=UTF-8");
        $result=json_encode($user);
        echo $result;
        exit;

    }
}
