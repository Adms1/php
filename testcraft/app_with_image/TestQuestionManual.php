<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestionManual extends Model
{
    protected $table = 'TestQuestionManual';
    protected $primaryKey = 'TestQuestionManualID';
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
        'TestQuestionManualID',
        'TestSectionQuestionTypeID',
        'QuestionID',
        'TestPackageTestID',
        'IsActive',
        'CreateDate',
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
     * TestPackageTest belongs to TestQuestionManual model
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestPackageTestID');
    }

    /**
     * Question belongs to TestQuestionManual model
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }

    /**
     * TestSectionQuestionType belongs to TestQuestionManual model
     */
    public function testSectionQuestionType()
    {
        return $this->belongsTo(TestSectionQuestionType::class, 'TestSectionQuestionTypeID');
    }
}
