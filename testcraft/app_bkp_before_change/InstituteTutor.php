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
}
