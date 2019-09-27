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
        'StatusID' => '2',
        'AccountTypeID' => '1',
        'IsActive' => '1',
        'Photo' => 'images/tutor/tutor_profile.png'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TutorID',
        'TutorName',
        'TutorEmail',
        'TutorPassword',
        'TutorPhoneNumber',
        'StatusID',
        'IsActive',
        'AccountTypeID',
        'Photo',
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
     * The tutors that belong to the Institute.
     * @param $input
     */
    public function institutes()
    {
        return $this->belongsToMany(Institute::class, 'InstituteTutor', 'TutorID', 'InstituteID');
    }
}
