<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'User';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserFullName', 'UserEmail', 'UserPassword', 'UserTypeID', 'IsActive',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'UserPassword',
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
        return $this->UserPassword;
    }

    // /**
    //  * Hash password
    //  * @param $input
    //  */
    // public function setPasswordAttribute($input)
    // {
    //     if ($input)
    //         $this->attributes['UserPassword'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    // }

    // /**
    //  * Set to null if empty
    //  * @param $input
    //  */
    // public function setRoleIdAttribute($input)
    // {
    //     $this->attributes['UserTypeID'] = $input ? $input : null;
    // }
    
    /**
     * role belongs to role model
     */
    public function userType()
    {
        return $this->belongsTo(userType::class, 'UserTypeID');
    }
}
