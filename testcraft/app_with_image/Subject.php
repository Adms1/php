<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'Subject';
    protected $primaryKey = 'SubjectID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'Icon' => 'images/subject/default-image.png'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SubjectID',
        'SubjectName',
        'IsActive',
        'CreateDate',
        'Icon'
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
