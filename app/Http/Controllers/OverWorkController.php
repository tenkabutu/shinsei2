<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverWorkController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){




        return view('overwork.create_ov');

    }
}
