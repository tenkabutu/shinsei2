<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function userlist(){

        $data = ['records' => DB::select(' SELECT * FROM users')];
        $userlist = user::with('roletag')->get();

        return view('user.userlist',compact('userlist'));

    }
}
