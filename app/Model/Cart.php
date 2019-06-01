<?php

namespace App\Model;

use App\Model\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    //
    use SoftDeletes;
    public function good(){
        return $this->hasOne('App\Model\Good','dog_id','dog_id');
    }
}
