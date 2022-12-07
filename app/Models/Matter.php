<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $fillable = ['user_id','reception_id','matter_type','matter_request_date','matter_reply_date','matter_change_date','order_content',
            'work_content','status','hour1','hour2','minutes1','minutes2','breaktime','allotted','allotted2'];
    protected $dates = ['matter_change_date','matter_request_date','matter_reply_date'];
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function mattertag(){
        return $this->belongsTo('App\Models\Nametag','matter_type','tagid')->where('groupid', '=', 4);
    }
    public function tasklist(){
        return $this->hasMany('App\Models\Task');
    }

}
