<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'Course';
    protected $primaryKey = 'CourseID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'Icon' => 'images/course/default-image.png'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CourseID',
        'CourseTypeID',
        'CourseName',
        'IsActive',
        'CreateDate',
        'Icon'
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
     * CourseType belongs to course model
     */
    public function courseType()
    {
        return $this->belongsTo(CourseType::class, 'CourseTypeID');
    }
}
