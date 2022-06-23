<?php

namespace App\Models;

use App\Notifications\Admin\Auth\ResetPassword;
use App\Notifications\Admin\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'mobile','active'
    ];

    protected $appends = [
        'avatar_url',
    ];
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function getAvatarUrlAttribute()
    {
        if($this->avatar){

            return asset('uploads/admins/'. $this->id . '/'.$this->avatar);

            return public_path('uploads/admins/' . $this->id . '/'.$this->avatar);
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
