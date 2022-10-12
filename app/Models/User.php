<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
    public function worktype(){
        return $this->belongsTo('App\Models\WorkType');
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
}
