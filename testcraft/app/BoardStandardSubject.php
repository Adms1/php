<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardStandardSubject extends Model
{
    protected $table = 'BoardStandardSubject';
    protected $primaryKey = 'BoardStandardSubjectID';
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
        'BoardStandardSubjectID',
        'BoardID',
        'StandardID',
        'SubjectID',
        'IsActive',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'TPGuid',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        /*'CreateDate' => 'datetime',*/
    ];

    /**
     * BoardStandardSubject belongs to course model
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'BoardID');
    }

    /**
     * BoardStandardSubject belongs to course model
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'StandardID');
    }

    /**
     * BoardStandardSubject belongs to subject model
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }
}
