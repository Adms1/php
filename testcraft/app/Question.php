<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Question extends Model
{
    protected $table = 'Question';
    protected $primaryKey = 'QuestionID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'IsTranslated' => '0',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'QuestionID',
        'QuestionText',
        'QuestionTypeID',
        'Marks',
        'DifficultyLevelID',
        'QuestionImage',
        'TutorID',
        'IsTranslated',
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
     * Set to null if empty
     * @param $input
     */
    public function setTutorIDAttribute()
    {
        $this->attributes['TutorID'] = Auth::guard('tutor')->user()->TutorID;
    }

    /**
     * Question has one QuestionHint model
     */
    public function hint()
    {
        return $this->hasone(QuestionHint::class, 'QuestionID');
    }

    /**
     * Question has one QuestionExplaination model
     */
    public function explaination()
    {
        return $this->hasone(QuestionExplaination::class, 'QuestionID');
    }

    /**
     * Question belongs to BoardStandardSubjectChapterTopicQuestion model
     */
    public function bssctQuestion()
    {
        return $this->hasone(BoardStandardSubjectChapterTopicQuestion::class, 'QuestionID');
    }
}