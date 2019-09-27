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
     * TestQuestionManual belongs to TestPackageTest
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestPackageTestID');
    }

    /**
     * TestQuestionManual belongs to Question
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }

    /**
     * TestQuestionManual belongs to TestSectionQuestionType
     */
    public function testSectionQuestionType()
    {
        return $this->belongsTo(TestSectionQuestionType::class, 'TestSectionQuestionTypeID');
    }
}
