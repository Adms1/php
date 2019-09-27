<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestPackageTest extends Model
{
    protected $table = 'TestPackageTest';
    protected $primaryKey = 'TestPackageTestID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'TestTypeID' => '1',
        'NumberofQuestion' => '0',
        'StatusID' => '10',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TestPackageTestID',
        'TestPackageID',
        'TestTypeID',
        'TestName',
        'NumberofQuestion',
        'TestDuration',
        'TestMarks',
        'DifficultyLevelID',
        'IsActive',
        'CreateDate',
        'StatusID',
        'TestInstruction'
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
     * TestPackageTest belongs to TestPackage
     */
    public function testPackage()
    {
        return $this->belongsTo(TestPackage::class, 'TestPackageID');
    }

    /**
     * TestPackageTest belongs to TestType
     */
    public function testType()
    {
        return $this->belongsTo(TestType::class, 'TestTypeID');
    }

    /**
     * TestPackageTest belongs to DifficultyLevel
     */
    public function difficultyLevel()
    {
        return $this->belongsTo(DifficultyLevel::class, 'DifficultyLevelID');
    }

    /**
     * TestPackageTest belongs to Status
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'StatusID');
    }
}
