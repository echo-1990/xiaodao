<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\IdScope;

class Test extends Model
{
    //
    protected $guarded = [];
    protected $primaryKey = 'id';
    use SoftDeletes;


    public function scopeMaxid($query)
    {
        return $query->where('id','>','500');
    }
    public function scopeMinid($query)
    {
        return $query->where('id','<','100');
    }
    public function scopeOfName($query, $name)
    {
        return $query->where('name', $name);
    }

}
