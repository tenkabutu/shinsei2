<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Matter;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OverWorkController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);


        return view('overwork.create_ov',compact('user'));

    }
    public function store(Request $request){
        $request->validate([
                'order_content' => ['required', 'string', 'max:255'],
                'reception_date' => ['required', 'string', 'max:255'],
                'school_id' => ['required', 'integer', 'max:255']
                //'email' => ['required', 'string', 'email', 'max:255', 'unique:users']

        ]);
        //var_dump($request->device_name);
        /* $date=Carbon::now()->toDateTimeString();
        $matter = new Matter();
        if($request->etc3==1){
            $request->merge(['delivery_order' =>$date]);
        } */
        $matter = new Matter();
        $matter ->fill($request->except('_token'))->save();
        /* $id = $matter->id;
        $category =new category();
        if($request->device_id){
            $category->cfg1=1;
        }
        $category->matter_id=$id;
        $category->save(); */


        $request->session()->regenerateToken();
        $id = $matter->id;

        //event(new Registered($user));

        //@foreach ($records as $id =>$record)
        return  redirect('overwork/'.$id.'/edit_ov');
    }
}
