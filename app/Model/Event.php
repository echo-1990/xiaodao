<?php

namespace App\Model;

use App\Model\Model;

class Event extends Model
{
    //
    public function eventable(){
        return $this->morphTo();
    }
}
