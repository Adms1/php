<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardStandardSubjectChapterTopic extends Model
{
    protected $table = 'BoardStandardSubjectChapterTopic';
    protected $primaryKey = 'BoardStandardSubjectChapterTopicID';
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
        'BoardStandardSubjectChapterTopicID',
        'BoardID',
        'StandardID',
        'SubjectID',
        'ChapterID',
        'TopicID',
        'CreateDate',
        'IsActive'
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
     * BoardStandardSubjectChapterTopic belongs to Board
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'BoardID');
    }

    /**
     * BoardStandardSubjectChapterTopic belongs to Standard
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'StandardID');
    }

    /**
     * BoardStandardSubjectChapterTopic belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * BoardStandardSubjectChapterTopic belongs to Chapter
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'ChapterID');
    }

    /**
     * BoardStandardSubjectChapterTopic belongs to Topic
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'TopicID');
    }
}
