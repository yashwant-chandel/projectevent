<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registeruser extends Model
{
    use HasFactory;

    public function event_dates(){
        return $this->hasOne(Session::class,'id','event_date');
    }
}
