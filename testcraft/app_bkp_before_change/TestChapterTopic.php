<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestChapterTopic extends Model
{
    protected $table = 'TestChapterTopic';
    protected $primaryKey = 'TestChapterTopicID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TestChapterTopicID',
        'TestPackageTestID',
        'ChapterID',
        'TopicID',
        'Weightage',
    ];

    /**
     * TestChapterTopic belongs to TestPackageTest
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestPackageTestID');
    }

    /**
     * TestChapterTopic belongs to Chapter
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'ChapterID');
    }

    /**
     * TestChapterTopic belongs to Topic
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'TopicID');
    }
}
