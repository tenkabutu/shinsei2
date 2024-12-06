<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // 入力可能なカラムを指定
    protected $fillable = [
            'user_id',
            'check_in',
            'check_out',
    ];

    /**
     * ユーザーとのリレーション
     * Attendance は User に属する
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
