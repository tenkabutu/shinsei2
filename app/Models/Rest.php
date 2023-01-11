<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    protected $fillable = ['user_id','rest_year','rest_allotted','carry_over'];
    //protected $dates = ['task_change_date','task_request_date','task_reply_date'];
    use HasFactory;
}
