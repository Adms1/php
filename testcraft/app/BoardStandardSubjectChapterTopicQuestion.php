<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BoardStandardSubjectChapterTopicQuestion extends Model
{
    protected $table = 'BoardStandardSubjectChapterTopicQuestion';
    protected $primaryKey = 'TopicQuestionID';
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
        'TopicQuestionID',
        'BSSCTopicID',
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
     * BSSCTopic belongs to question model
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }

    /**
     * BSSCTQuestion belongs to BSSCT model
     */
    public function bssct()
    {
        return $this->belongsTo(BoardStandardSubjectChapterTopic::class, 'BSSCTopicID');
    }
}
