<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $fillable = ['user_id','reception_id','matter_type','matter_request_date','matter_reply_date','matter_change_date','order_content',
            'work_content','status','starttime','endtime','breaktime','allotted'];
    protected $dates = ['matter_change_date','matter_request_date','matter_reply_date','starttime','endtime'];
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function mattertag(){
        return $this->belongsTo('App\Models\Nametag','matter_type','tagid')->where('groupid', '=', 4);
    }
}
