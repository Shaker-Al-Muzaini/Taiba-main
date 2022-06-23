<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name','mobile','state_id'];
    protected $appends=['state_name'];
    public function state(){
        return $this->belongsTo(State::class,'state_id')->withTrashed();
    }
    public function getStateNameAttribute()
    {
        $state= $this->state;
        if($state){
            return $state->name;
        }
        return null;
    }
}
