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
        'Marks' => 'decimal:2',
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
     * Question has one Hint
     */
    public function hint()
    {
        return $this->hasone(QuestionHint::class, 'QuestionID');
    }

    /**
     * Question has one Explaination
     */
    public function explaination()
    {
        return $this->hasone(QuestionExplaination::class, 'QuestionID');
    }

    /**
     * Question belongs to BoardStandardSubjectChapterTopicQuestion
     */
    public function bssctQuestion()
    {
        return $this->hasone(BoardStandardSubjectChapterTopicQuestion::class, 'QuestionID');
    }

    /**
     * Question belongs to CourseSubjectTopicQuestion
     */
    public function cstQuestion()
    {
        return $this->hasone(CourseSubjectTopicQuestion::class, 'QuestionID');
    }

    /**
     * Question belongs to QuestionType
     */
    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'QuestionTypeID');
    }

    /**
     * Question belongs to difficultyLevel
     */
    public function difficultyLevel()
    {
        return $this->belongsTo(DifficultyLevel::class, 'DifficultyLevelID');
    }

    /**
     * Returns the checkbox column html for datatables.
     *
     * @param \App\Question
     * @return string
     */
    public static function laratablesCustomAction($question)
    {
        return view('partials.question_checkbox_action', compact('question'))->render();
    }

    /**
     * Returns the view action column html for datatables.
     *
     * @param \App\Question
     * @return string
     */
    public static function laratablesCustomView($question)
    {
        return view('partials.question_view_action', compact('question'))->render();
    }

    /**
     * Returns the name column value for datatables.
     *
     * @param \App\Question
     * @return string
     */
    public static function laratablesCustomQuestionTypeID($question)
    {
        return $question->QuestionTypeID;
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['QuestionTypeID'];
    }
}