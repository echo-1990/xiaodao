<?php

namespace App\Model;

use App\Model\Model;
use Illuminate\Support\Facades\DB;

class Dog extends Model
{
    //
    protected $guarded=[];

    public function good(){
        return $this->hasOne('App\Model\Good','dog_id','id');
    }
    public function pic(){
        return $this->hasMany('App\Model\Pic','dog_id','id');
    }
    public function mother(){
        return $this->hasOne('App\Model\Breeddog','id','mother_id');
    }
    public function father(){
        return $this->hasOne('App\Model\Breeddog','id','father_id');
    }
    public function vaccine(){
        return $this->hasMany('App\Model\Vaccine','dog_id','id');
    }
    public function uninsect(){
        return $this->hasMany('App\Model\Uninsect','dog_id','id');
    }
    public function video(){
        return $this->hasMany('App\Model\Video','dog_id','id');
    }
    public function weight(){
        return $this->hasMany('App\Model\Weight','dog_id','id');
    }

    public function reproduction(){
        return $this->hasMany(
            'App\Model\Event',
            'eventable_id',
            'reproduction_id')
            ->where('eventable_type','=','App\Model\Reproduction');
    }
    public function reproductionpic(){

        return $this->hasManyThrough(
            'App\Model\Eventpic',
            'App\Model\Event',
            'eventable_id',
            'event_id',
            'reproduction_id',
            'id')
            ->where('events.eventable_type','=','App\Model\Reproduction');
    }


    public function event(){
        return $this->morphMany(
            'App\Model\Event',
            'eventable',
            'eventable_type',
            'eventable_id',
            'id'
        );
    }
    public function eventpic(){

        return $this->hasManyThrough(
            'App\Model\Eventpic',
            'App\Model\Event',
            'eventable_id',
            'event_id',
            'id',
            'id'
        )->where('events.eventable_type','App\Model\Dog');
    }
    public function cart(){
        return $this->hasOne('App\Model\Cart','dog_id','id');
    }
}
