<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrueFalseQuesionAnswer extends Model
{
    protected $table = 'TrueFalseQuesionAnswer';
    protected $primaryKey = 'TrueorFalseID';
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
        'TrueorFalseID',
        'IsTrue',
        'TorFQuestionID',
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
