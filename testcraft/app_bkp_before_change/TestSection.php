<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSection extends Model
{
    protected $table = 'TestSection';
    protected $primaryKey = 'TestSectionID';
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
        'TestSectionID',
        'TestPackageTestID',
        'SectionName',
        'SectionDescription',
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
     * TestSection belongs to TestPackageTest
     */
    public function test()
    {
        return $this->belongsTo(TestPackageTest::class, 'TestPackageTestID');
    }

    /**
     * TestSection belongs to TestSectionQuestionType
     */
    public function questionTypes()
    {
        return $this->hasMany(TestSectionQuestionType::class, 'TestSectionID');
    }
}
