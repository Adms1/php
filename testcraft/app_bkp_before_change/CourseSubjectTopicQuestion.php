<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class CourseSubjectTopicQuestion extends Model
{
    protected $table = 'CourseSubjectTopicQuestion';
    protected $primaryKey = 'CourseSubjectTopicQuestionID';
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
        'CourseSubjectTopicQuestionID',
        'CourseSubjectTopicID',
        'QuestionID',
        'IsActive',
        'CreateDate'
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
     * BSSCTopic belongs to Question
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }

    /**
     * CSTQuestion belongs to CourseSubjectTopic
     */
    public function cst()
    {
        return $this->belongsTo(CourseSubjectTopic::class, 'CourseSubjectTopicID');
    }
}
