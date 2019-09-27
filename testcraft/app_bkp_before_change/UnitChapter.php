<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitChapter extends Model
{
    protected $table = 'UnitChapter';
    protected $primaryKey = 'UnitChapterID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'Weightage' => '1',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UnitChapterID',
        'UnitID',
        'BoardID',
        'StandardID',
        'SubjectID',
        'ChapterID',
        'Weightage',
        'CreateDate',        
        'IsActive'
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
     * UnitChapter belongs to Board
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'BoardID');
    }

    /**
     * UnitChapter belongs to Standard
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'StandardID');
    }

    /**
     * UnitChapter belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * UnitChapter belongs to Chapter
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'ChapterID');
    }

    /**
     * UnitChapter belongs to Unit
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'UnitID');
    }
}
