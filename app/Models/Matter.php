<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $fillable = ['user_id','reception_id','matter_type','matter_request_date','matter_reply_date','matter_change_date','order_content',
            'work_content','reject_content','status','hour1','hour2','minutes1','minutes2','breaktime','allotted','allotted2','opt1','opt2','nendo'];
    protected $dates = ['matter_change_date','matter_request_date','matter_reply_date'];
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function reception(){
        return $this->belongsTo('App\Models\User','reception_id');
    }
    public function mattertag(){
        return $this->belongsTo('App\Models\Nametag','matter_type','tagid')->where('groupid', '=', 4);
    }
    public function opt1tag(){
        return $this->belongsTo('App\Models\Nametag','opt1','tagid')->where('groupid', '=', 6);
    }
    public function tasklist(){
        return $this->hasMany('App\Models\Task');
    }
   /*  public function task(){
        return $this->hasOne('App\Models\Task')->latestOfMany()->where('opt5', '=', 0);
    } */

}
