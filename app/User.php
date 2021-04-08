<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [


        'name', 'ucountry','utype','email', 'password','username'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

/*
    public function posts(){
        return $this->hasMany('App\Post');
    }
    ****/
    public function misss(){
        return $this->hasMany('App\Miss');
    }
    public function ptmisss(){
        return $this->hasMany('App\Ptmiss');
    }
    public function massages(){
        return $this->hasMany('App\Massage');
    }
    public function contracts(){
        return $this->hasMany('App\Contract');
    }
    public function mores(){
        return $this->hasMany('App\More');
    }
    public function baoyangs(){
        return $this->hasMany('App\Baoyang');
    }
    public function escorths(){
        return $this->hasMany('App\Escorth');
    }
    public function escortbs(){
        return $this->hasMany('App\Escortb');
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
