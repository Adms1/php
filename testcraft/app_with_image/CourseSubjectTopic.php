<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSubjectTopic extends Model
{
    protected $table = 'CourseSubjectTopic';
    protected $primaryKey = 'CourseSubjectTopicID';
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
        'CourseSubjectTopicID',
        'CourseID',
        'SubjectID',
        'TopicID',
        'IsActive',
        'CreateDate'
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

    /**
     * CourseSubjectTopic belongs to course model
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID');
    }

    /**
     * CourseSubjectTopic belongs to subject model
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * CourseSubjectTopic belongs to topic model
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'TopicID');
    }
}
