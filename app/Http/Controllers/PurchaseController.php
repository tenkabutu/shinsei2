<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShinseiRequest;
use App\Http\Traits\Submethod;
use App\Models\Matter;
use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    use Submethod;
    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){

        $user=User::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);

        $check_userlist=$this->pu_check_userlist();
        return view('purchase.create_pu',compact('user','check_userlist'));
    }
    public function save_request(ShinseiRequest $request){

        $matter = new Matter();
        $request->merge(['status' =>2]);
        $date=Carbon::now()->toDateTimeString();
        $request->merge(['matter_request_date' =>$date]);
        $carbon = new CarbonImmutable($request->matter_change_date);
        $request->merge(['nendo' =>$carbon->subMonthsNoOverflow(3)->format('Y')]);
        $matter ->fill($request->except('_token'))->save();
        $id = $matter->id;

        $request->session()->regenerateToken();

        return  redirect($id.'/show_pu');
    }
    public function update_request(ShinseiRequest $request,$id){
        $matter =matter::find($id);
        $matter->fill($request->except('_token'));
        if($matter->isDirty()&&$request->change_check==1){
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_request_date=$date;
            $matter->status=2;
            $matter->save();
            return  redirect($id.'/show_pu');
        }elseif($matter->isDirty()){
            $request->change_check=1;
            return back()->withInput()->with('save_check', '申請済の内容が変更されています、保存する場合再申請が必要になりますがよろしいですか？');
        }

        $request->session()->regenerateToken();
        // $id = $matter->id;
        return  redirect($id.'/show_pu');
    }
    public function show_pu($id){

        $matter = Matter::with('tasklist')->findOrFail($id);
        //$task_count = task::where('matter_id',$id)->where('task_status',2)->count();


        //$user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);
        $user=user::with('roletag','approvaltag','areatag','worktype')->findOrFail($matter->user_id);


        $check_userlist=$this->pu_check_userlist();

            //  with('roletag','approvaltag','areatag','worktype')->findOrFail(Auth::user()->id);

        return view('purchase.create_pu',compact('user','matter','check_userlist'));
    }
    public function purcher_accept(Request $request,$id){

        $matter = Matter::findOrFail($id);
        $userId = $request->input('user_id');
        $name = $request->input('name');
        $matter->update([$name => $userId]);
       // $matter = Matter::findOrFail($id);
        if($matter->hour1!=0 && $matter->hour2 !=0&& $matter->minutes1!=0){
            $matter->status=7;
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_reply_date=$date;
            $matter->update();
            return  redirect($id.'/show_pu');

        }elseif($matter->hour1!=0 && $matter->hour2 !=0){
            $matter->status=3;
            $date=Carbon::now()->toDateTimeString();
            $matter->matter_reply_date=$date;
            $matter->update();
            return  redirect($id.'/show_pu');
        }


        return response()->json(['status' => 'success']);

    }
    public static function pu_check_userlist(){
        $check_userlist = User::where('permissions', '&',2)
        ->get(['id', 'name']);

        return $check_userlist;
    }

}
