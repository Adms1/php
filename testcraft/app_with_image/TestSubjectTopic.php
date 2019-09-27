<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSubjectTopic extends Model
{
    protected $table = 'TestSubjectTopic';
    protected $primaryKey = 'TestSubjectTopicID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TestSubjectTopicID',
        'TestPackageTestID',
        'SubjectID',
        'TopicID',
        'Weightage',
    ];

    /**
     * TestChapterTopic belongs to TestPackageTest model
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestPackageTestID');
    }

    /**
     * TestPackageTest belongs to Subject model
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * TestPackageTest belongs to Topic model
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'TopicID');
    }
}
