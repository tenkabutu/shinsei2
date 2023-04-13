<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function userlist(){


        $userlist = user::with('roletag','approvaltag','areatag','worktype')->orderBy('employee','asc')->get();

        return view('user.userlist',compact('userlist'));

    }
    public function user_change(Request $request){
       // $request->headers->set('Accept','application/json');
        //print_r($request->toArray());

        $user=user::find($request->id);
        $user->update($request->except('_token'));

        //$user2=user::find($request->id);
       // echo $user2->id;
      //  $request->expectsJson();
        //return response()->json($request->expectsJson(), 500);
        header("Content-type: application/json; charset=UTF-8");
        $result=json_encode($user);
        echo $result;
        exit;

    }
}
