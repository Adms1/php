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
     * CourseSubjectTopic belongs to Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID');
    }

    /**
     * CourseSubjectTopic belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * CourseSubjectTopic belongs to Topic
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'TopicID');
    }
}
