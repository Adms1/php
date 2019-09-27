<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    protected $table = 'TestType';
    protected $primaryKey = 'TestTypeID';
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
        'TestTypeID',
        'TestTypeName',
        'IsActive',
        'NumberofQuestion',
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
