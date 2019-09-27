<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class InvoiceDetail extends Model
{
    protected $table = 'InvoiceDetail';
    protected $primaryKey = 'InvoiceDetailID';
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
        'InvoiceDetailID',
        'InvoiceID',
        'CartID',
        'TestPackageID',
        'Quantity',
        'TestPackageSalePrice',
        'Amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'TestPackageSalePrice' => 'decimal:2',
        'Amount' => 'decimal:2',
    ];

    /**
     * InvoiceDetail belongs to Invoice model
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'InvoiceID');
    }

    /**
     * InvoiceDetail belongs to Cart model
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'CartID');
    }

    /**
     * InvoiceDetail belongs to TestPackage model
     */
    public function testPackage()
    {
        return $this->belongsTo(TestPackage::class, 'TestPackageID');
    }
}