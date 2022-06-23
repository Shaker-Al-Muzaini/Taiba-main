<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name',
        'email',
        'state_id',
        'type_status',
        'mobile'
    ];
    protected $appends = [
        'avatar_url',
        'state_name',
        'type_status_label',
    ];

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
    public function getAvatarUrlAttribute()
    {
        if($this->avatar){

            return asset('uploads/drivers/'. $this->id . '/'.$this->avatar);
        }

        return asset('uploads/avatar.png');
    }
    public function gettypeStatusLabelAttribute()
    {
        return [
            'daily'=>'يومي',
            'new_daily'=>'يومي جديد',
            'vacation'=>'إجازة',
        ][$this->type_status];
    }
}
