<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nametag extends Model
{
    use HasFactory;
    public function roletag(){
        return $this->hasMany('App\Models\Nametags','role')->where('groupid', '=', 1);
    }
    public function approvaltag(){
        return $this->hasMany('App\Models\User','approval');
    }
    public function areatag(){
        return $this->hasMany('App\Models\User','area');
    }
}
