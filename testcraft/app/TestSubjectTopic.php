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
     * TestSubjectTopic belongs to TestPackageTest
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestPackageTestID');
    }

    /**
     * TestSubjectTopic belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * TestSubjectTopic belongs to Topic
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'TopicID');
    }
}
