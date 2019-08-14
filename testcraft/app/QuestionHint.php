<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionHint extends Model
{
    protected $table = 'QuestionHint';
    protected $primaryKey = 'QuestionID';
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
        'QuestionHintID',
        'QuestionID',
        'HintText',
        'HintImage',
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
     * QuestionHint belongs to question model
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }
}
