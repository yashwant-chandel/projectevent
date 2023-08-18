<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function event_data(){
        return $this->hasOne(Event_Meta::class,'section_id','id');
    }
}
