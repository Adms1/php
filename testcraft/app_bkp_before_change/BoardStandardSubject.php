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
     * BoardStandardSubject belongs to Board
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'BoardID');
    }

    /**
     * BoardStandardSubject belongs to Standard
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'StandardID');
    }

    /**
     * BoardStandardSubject belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }
}
