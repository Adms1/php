<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Invoice extends Model
{
    protected $table = 'Invoice';
    protected $primaryKey = 'InvoiceID';
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
        'InvoiceID',
        'StudentID',
        'StatusID',
        'CouponID',
        'PaymentTransactionID',
        'InvoiceNumber',
        'Amount',
        'TaxAmount',
        'IsActive',
        'CreateDate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'InvoiceGUID',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'CreateDate' => 'datetime:Y-m-d h:i:s a',
        'Amount' => 'decimal:2',
        'TaxAmount' => 'decimal:2',
    ];

    /**
     * Invoice belongs to student model
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentID');
    }

    /**
     * Invoice belongs to status model
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'StatusID');
    }

    /**
     * Invoice belongs to PaymentTransaction model
     */
    public function paymentTransaction()
    {
        return $this->belongsTo(PaymentTransaction::class, 'PaymentTransactionID');
    }

    /**
     * Invoice has many to Invoice Detail model
     */
    public function invoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class, 'InvoiceID');
    }
}
