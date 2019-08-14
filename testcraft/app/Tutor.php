<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tutor extends Authenticatable
{
    use Notifiable;
    protected $guard = 'tutor';
    protected $table = 'Tutor';
    protected $primaryKey = 'TutorID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'StatusID' => '1',
        'AccountTypeID' => '1',
        'IsActive' => '1',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TutorID', 'TutorName', 'TutorEmail', 'TutorPassword', 'TutorPhoneNumber', 'StatusID', 'IsActive', 'AccountTypeID',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        /*'TutorPassword',*/
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'CreateDate' => 'datetime',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->TutorPassword;
    }
    
    /**
     * Hash password
     * @param $input
     */
    // public function setPasswordAttribute($input)
    // {
    //     if ($input)
    //         $this->attributes['TutorPassword'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    // }
}
