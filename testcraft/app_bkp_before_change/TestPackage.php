<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TestPackage extends Model
{
    public $timestamps = false;
    protected $table = 'TestPackage';
    protected $primaryKey = 'TestPackageID';

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'Icon' => 'images/package/package_default.png',
        'StatusID' => '10',
        /*'TestPackageListPriceTCD' => '1',
        'TestPackageSalePriceTCD' => '1',*/
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TestPackageID',
        'BoardID',
        'StandardID',
        'SubjectID',
        'CourseID',
        'TutorID',
        'TestPackageName',
        'TestPackageDescription',
        'TestPackageSalePrice',
        'TestPackageListPrice',
        'TestPackageSalePriceTCD',
        'TestPackageListPriceTCD',
        'NumberOfTest',
        'IsActive',
        'IsCompetetive',
        'QuestionFrom',
        'IsAutoTestCreation',
        'CreateDate',
        'Icon',
        'StatusID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'TPGuid',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'CreateDate' => 'datetime',
        'TestPackageSalePrice' => 'decimal:2',
        'TestPackageListPrice' => 'decimal:2',
        'TestPackageSalePriceTCD' => 'decimal:2',
        'TestPackageListPriceTCD' => 'decimal:2',
    ];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTutorIDAttribute()
    {
        $this->attributes['TutorID'] = Auth::guard('tutor')->user()->TutorID;
    }

    /**
     * TestPackage belongs to Board
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'BoardID');
    }

    /**
     * TestPackage belongs to Standard
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'StandardID');
    }

    /**
     * TestPackage belongs to Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    /**
     * TestPackage belongs to Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID');
    }

    /**
     * TestPackage belongs to Status
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'StatusID');
    }

    /**
     * TestPackage belongs to Tutor
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'TutorID');
    }

    /**
     * TestPackage has many Tests
     */
    public function tests()
    {
        return $this->hasMany(TestPackageTest::class, 'TestPackageID');
    }

    /**
     * TestPackage has many InvoiceDetails
     */
    public function invoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class, 'InvoiceDetailID');
    }
}
