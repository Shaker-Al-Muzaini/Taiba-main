<?php

namespace App\Models;

use App\Notifications\Agent\Auth\ResetPassword;
use App\Notifications\Agent\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;
class Agent extends Authenticatable
{
    use HasFactory, Notifiable , SoftDeletes;
    protected $fillable = [
        'name', 'email', 'password','state_id'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'avatar_url',
        'state_name',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


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
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    public function getAvatarUrlAttribute()
    {
        if($this->avatar){

                return asset('uploads/agents/'. $this->id . '/'.$this->avatar);

            return public_path('uploads/agents/' . $this->id . '/'.$this->avatar);
//        return Storage::url('agents/'.$this->id.'/'.$this->avatar);
        }

       return asset('uploads/avatar.png');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}
