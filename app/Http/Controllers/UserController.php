<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function userlist(){

        $data = ['records' => DB::select(' SELECT * FROM users')];

        return view('user.userlist', $data);

    }
}
