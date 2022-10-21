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
    public function save(Request $request){

        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],
                //'user_id' => ['required', 'integer', 'max:255']
                //'starttime' => ['required', 'string', 'email', 'max:255', 'unique:users']

        ]);
        //var_dump($request->device_name);
        /* $date=Carbon::now()->toDateTimeString();
        $matter = new Matter();
        if($request->etc3==1){
            $request->merge(['delivery_order' =>$date]);
        } */
        $matter = new Matter();
        $matter ->fill($request->except('_token'))->save();

        $request->session()->regenerateToken();
        $id = $matter->id;

        //event(new Registered($user));

        //@foreach ($records as $id =>$record)
        return  redirect($id.'/rewrite_ov');
    }
    public function save_request(Request $request){
        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],

        ]);
        $matter = new Matter();
        $request->merge(['status' =>2]);
        $date=Carbon::now()->toDateTimeString();
        $request->merge(['matter_request_date' =>$date]);
        $matter ->fill($request->except('_token'))->save();
        $request->session()->regenerateToken();
        $id = $matter->id;
        return  redirect($id.'/rewrite_ov');
    }

    public function update(Request $request,$id){
        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],

        ]);

        $matter =matter::find($id);
        $matter->fill($request->except('_token'));

        if($matter->isDirty()&&$request->change_check==1){
            $matter->status=1;
            $matter->save();
            return  redirect($id.'/rewrite_ov');
        }elseif($matter->isDirty()){

            $request->merge(['change_check' =>1]);
            return back()->withInput()->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');

        }

        $request->session()->regenerateToken();
        //$id = $matter->id;
        return  redirect($id.'/rewrite_ov');
    }
    public function update_request(Request $request,$id){
        $request->validate([
                'matter_change_date' => ['required', 'string', 'max:55'],
                'order_content' => ['required', 'string', 'max:255'],

        ]);
        $request->merge(['status' =>2]);
        $matter =matter::find($id)
        ->fill($request->except('_token'))->save();
        $request->session()->regenerateToken();
       // $id = $matter->id;
        return  redirect($id.'/rewrite_ov');
    }
    public function show_ov($id){

        $matter = matter::findOrFail($id);
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);

        return view('overwork.create_ov',compact('user','matter'));


    }

}
