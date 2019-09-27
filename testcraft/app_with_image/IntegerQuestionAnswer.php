<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegerQuestionAnswer extends Model
{
    protected $table = 'IntegerQuestionAnswer';
    protected $primaryKey = 'IntegerAnswerID';
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
        'IntegerAnswerID',
        'INTText',
        'INTQuestionID',
        'IsActive',
        'MinValue',
        'MaxValue',
        'CreateDate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'INTGuid',
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
