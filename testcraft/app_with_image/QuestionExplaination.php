<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionExplaination extends Model
{
    protected $table = 'QuestionExplaination';
    protected $primaryKey = 'QuestionExplainationID';
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
        'QuestionExplainationID',
        'QuestionID',
        'ExplainationText',
        'ExplainationImage',
        'IsActive',
        'CreateDate'
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
     * QuestionExplaination belongs to question model
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }
}
