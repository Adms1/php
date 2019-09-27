<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstituteTutor extends Model
{
    protected $table = 'InstituteTutor';
    protected $primaryKey = 'InstituteTutorID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'InstituteTutorID',
        'InstituteID',
        'TutorID',
        'IsActive',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'TPGuid',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        /*'CreateDate' => 'datetime',*/
    ];

    // /**
    //  * InstituteTutor belongs to institute model
    //  */
    // public function institute()
    // {
    //     return $this->belongsTo(Institute::class, 'InstituteID');
    // }

    // /**
    //  * InstituteTutor belongs to tutor model
    //  */
    // public function tutor()
    // {
    //     return $this->belongsTo(Tutor::class, 'TutorID');
    // }
}
