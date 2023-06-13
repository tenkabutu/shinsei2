<?php
namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait Submethod {
    public static function create_userlist (){
        $userlist = User::select('id','employee', 'name')->orderby('employee','asc')->get();
        $create_userlist = "";
        foreach ($userlist as $us) {
            $create_userlist .= '<option value="' . $us->id . '">' . $us->employee . ':' . $us->name . '</option>';
        };
        return $create_userlist;
    }

    public static function create_check_userlist(){
        $user=User::findOrFail(Auth::user()->id);

        $query=user::query();
        $area_id=$user->area;

        $query->where(function($query2) use($area_id){
            $query2->whereIn('users.role',[1,2])
            ->Where('users.area', $area_id)
            ->Where('users.approval',2);
        })->orwhere(function($query2){
            $query2->whereIn('users.role',[1,2])
            ->Where('users.approval',1);
        });
            $create_check_userlist=$query->get('name')->all();

            return $create_check_userlist;
    }
}