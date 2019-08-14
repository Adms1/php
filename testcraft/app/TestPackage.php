<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TestPackage extends Model
{
    protected $table = 'TestPackage';
    protected $primaryKey = 'TestPackageID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        /*'TestPackageListPriceTCD' => '1',
        'TestPackageSalePriceTCD' => '1',*/
    ];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTutorIDAttribute()
    {
        $this->attributes['TutorID'] = Auth::guard('tutor')->user()->TutorID;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    // public function setCourseIDAttribute($input)
    // {
    //     $this->attributes['CourseID'] = $input ? $input : 1;
    // }

    /**
     * Set to null if empty
     * @param $input
     */
    // public function setSubjectIDAttribute($input)
    // {
    //     $this->attributes['SubjectID'] = $input ? $input : 1;
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TestPackageID',
        'BoardID',
        'StandardID',
        'SubjectID',
        'CourseID',
        'TutorID',
        'TestPackageName',
        'TestPackageDescription',
        'TestPackageSalePrice',
        'TestPackageListPrice',
        'TestPackageSalePriceTCD',
        'TestPackageListPriceTCD',
        'NumberOfTest',
        'IsActive',
        'IsCompetetive',
        'QuestionFrom',
        'IsAutoTestCreation',
        'CreateDate',
        'Icon',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'TPGuid',
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
     * TestPackage belongs to course model
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'BoardID');
    }

    /**
     * TestPackage belongs to course model
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'StandardID');
    }

    /**
     * TestPackage belongs to subject model
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * TestPackage belongs to Course model
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID');
    }

    /**
     * TestPackage belongs to Tutor model
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'TutorID');
    }
}
