<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['matter_id','task_request_date','task_reply_date','task_change_date',
            'task_status','task_starttime','task_endtime','task_breaktime','task_allotted'];
    protected $dates = ['task_change_date','task_request_date','task_reply_date','task_starttime','task_endtime'];
    use HasFactory;
}
