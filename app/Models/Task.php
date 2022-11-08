<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['matter_id','task_request_date','task_reply_date','task_change_date',
            'task_status','task_hour1','task_hour2','task_minutes1','task_minutes2','task_breaktime','task_allotted'];
    protected $dates = ['task_change_date','task_request_date','task_reply_date'];
    use HasFactory;
}
