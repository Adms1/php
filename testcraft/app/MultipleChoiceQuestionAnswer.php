<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestionAnswer extends Model
{
    protected $table = 'MultipleChoiceQuestionAnswer';
    protected $primaryKey = 'MultipleChoiceQuestionAnswerID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'IsImage' => '0',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'MultipleChoiceQuestionAnswerID',
        'MCQAText',
        'MCQAQuestionID',
        'IsImage',
        'AnswerImage',
        'IsCorrectAnswer',
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
}
