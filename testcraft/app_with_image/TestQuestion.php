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
     * TestPackageTest belongs to TestQuestion model
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestID');
    }

    /**
     * Question belongs to TestQuestion model
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }

    /**
     * TestSectionQuestionType belongs to TestQuestion model
     */
    public function testSectionQuestionType()
    {
        return $this->belongsTo(TestSectionQuestionType::class, 'TPDSQuestionTypeID');
    }
}
