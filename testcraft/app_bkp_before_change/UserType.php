<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'UserType';
    protected $primaryKey = 'UserTypeID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserTypeID',
        'UserTypeGUID',
        'UserTypeName',
        'IsActive',
        'UserLevel',
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
