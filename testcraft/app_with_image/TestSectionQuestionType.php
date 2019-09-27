<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSectionQuestionType extends Model
{
    protected $table = 'TestSectionQuestionType';
    protected $primaryKey = 'TestSectionQuestionTypeID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'NegativeMarks' => '0',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TestSectionQuestionTypeID',
        'TestSectionID',
        'QuestionTypeID',
        'NumberofQuestion',
        'NegativeMarks',
        'QuestionMarks',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'CreateDate' => 'datetime',
        'NumberofQuestion' => 'decimal:2',
        'NegativeMarks' => 'decimal:2',
        'QuestionMarks' => 'decimal:2',
    ];

    /**
     * TestSectionQuestionType belongs to TestSection model
     */
    public function section()
    {
        return $this->belongsTo(TestSection::class, 'TestSectionID');
    }

    /**
     * TestSectionQuestionType belongs to QuestionType model
     */
    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'QuestionTypeID');
    }

    /**
     * TestSectionQuestionType has Many to TestQuestionManual model
     */
    public function testQuestion()
    {
        return $this->hasMany(TestQuestionManual::class, 'TestSectionQuestionTypeID');
    }
}
