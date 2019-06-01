<?php

namespace App\Model;

use App\Model\Model;
use App\Model\Dog;
use Illuminate\Support\Facades\DB;

class Good extends Model
{
    //
    public function dog(){
        return $this->hasOne('App\Model\Dog','id','dog_id');
    }
    public function pic(){
        return $this->hasOne('App\Model\Pic','dog_id','dog_id')->where(['usetype'=>1,'bodytype'=>1])->orderBy('created_at','desc');
    }
    public function scopebirthtoday(){
        return $this->addSelect(DB::raw('DATEDIFF(birth_at,NOW()) as birthtoday'));
    }
}
