<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{


    use HasApiTokens, HasFactory, Notifiable;
    public function roletag(){
        return $this->belongsTo('App\Models\Nametag','role','tagid')->where('groupid', '=', 1);
    }
    public function approvaltag(){
        return $this->belongsTo('App\Models\Nametag','approval','tagid')->where('groupid', '=', 2);
    }
    public function areatag(){
        return $this->belongsTo('App\Models\Nametag','area','tagid')->where('groupid', '=', 3);
    }
    public function Manage(){
        return $this->hasMany('App\Models\AreaData','manage','manage');
    }
    public function worktype(){
        return $this->belongsTo('App\Models\WorkType');
    }
    public function rest(){
        return $this->hasOne('App\Models\Rest','user_id','employee')->orderBy('rest_year', 'desc');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name2',
        'email',
        'password',
        'role',
        'approval',
        'area',
        'worktype_id',
        'employee',
        'hiring_day',
        'permissions',

    ];
    protected  $dates=[
        'hiring_day',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $url = url("reset-password/${token}");
        $this->notify(new ResetPasswordNotification($url));
    }
}
