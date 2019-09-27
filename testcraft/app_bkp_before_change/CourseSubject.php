<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSubject extends Model
{
    protected $table = 'CourseSubject';
    protected $primaryKey = 'CourseSubjectID';
    public $timestamps = false;

    /**
     * The attributes with default value.
     *
     * @var array
     */
    protected $attributes = [
       'IsActive' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CourseSubjectID',
        'CourseID',
        'SubjectID',
        'IsActive',
    ];

    /**
     * CourseSubject belongs to Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID');
    }

    /**
     * CourseSubject belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }
}
