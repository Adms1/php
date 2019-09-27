<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class PaymentTransaction extends Model
{
    protected $table = 'PaymentTransaction';
    protected $primaryKey = 'PaymentTransactionID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PaymentTransactionID',
        'PaymentTypeID',
        'StudentID',
        'PaymentAmount',
        'TaxAmount',
        'PaymentDate',
        'StatusID',
        'ExternalTransactionID',
        'ExternalTransactionStatusID',
        'PaymentOrderID',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'PaymentTransactionGUID',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'PaymentDate' => 'datetime:Y-m-d h:i:s a',
        'PaymentAmount' => 'decimal:2',
        'TaxAmount' => 'decimal:2',
    ];

    /**
     * PaymentTransaction belongs to Student model
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentID');
    }

    /**
     * PaymentTransaction belongs to status model
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'ExternalTransactionStatusID');
    }
}
