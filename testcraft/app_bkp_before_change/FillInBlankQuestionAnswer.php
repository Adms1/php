<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FillInBlankQuestionAnswer extends Model
{
    protected $table = 'FillInBlankQuestionAnswer';
    protected $primaryKey = 'FillInBlankAnswerID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'FIBOrder' => '1',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FillInBlankAnswerID',
        'FIBText',
        'FIBOrder',
        'FIBQuestionID',
        'IsActive',
        'CreateDate',
        'AnswerImage'
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
