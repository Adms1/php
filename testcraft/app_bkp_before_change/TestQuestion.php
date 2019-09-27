<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $table = 'TestQuestion';
    protected $primaryKey = 'TestQuestionID';
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
        'TestQuestionID',
        'TPDSQuestionTypeID',
        'QuestionID',
        'TestID',
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
     * TestQuestion belongs to TestPackageTest
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestID');
    }

    /**
     * TestQuestion belongs to Question
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }

    /**
     * TestQuestion belongs to TestSectionQuestionType
     */
    public function testSectionQuestionType()
    {
        return $this->belongsTo(TestSectionQuestionType::class, 'TPDSQuestionTypeID');
    }
}
