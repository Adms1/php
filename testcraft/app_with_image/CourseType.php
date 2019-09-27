<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = 'CourseType';
    protected $primaryKey = 'CourseTypeID';
    public $timestamps = false;

    /**
     * The attributes with default value.
     *
     * @var array
     */
    protected $attributes = [
       'IsActive' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CourseTypeID',
        'CourseTypeName',
        'IsActive',
        'CreateDate',
        'Icon',
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
