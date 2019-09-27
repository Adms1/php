<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'Institute';
    protected $primaryKey = 'InstituteID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'InstituteID',
        'InstituteName',
        'IsActive',
        'CreateDate',
        /*'Icon'*/
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
     * The institutes that belong to the tutors.
     * @param $input
     */
    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'InstituteTutor', 'InstituteID', 'TutorID');
    }
}
