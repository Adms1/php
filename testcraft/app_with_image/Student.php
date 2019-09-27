<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'Student';
    protected $primaryKey = 'StudentID';
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
        'StudentID',
        'StudentEmailAddress',
        'StudentPassword',
        'StudentFirstName',
        'StudentLastName',
        'StudentMobile',
        'CreateDate',
        'IsActive',
        'StatusID',
        'AccountTypeID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'StudentGUid',
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
     * concat first name and last name
     */
    public function getFullNameAttribute($value)
    {
       return ucfirst($this->StudentFirstName) . ' ' . ucfirst($this->StudentLastName);
    }

    /**
     * Invoice belongs to status model
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'StatusID');
    }
}
