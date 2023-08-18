<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;


    public function session(){
       return $this->hasOne(Session::class,'event_id','id');
    }
    public function section(){
        return $this->hasOne(Session::class,'event_id','id');
     }
}
