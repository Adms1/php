<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class BookVendor.
 *
 * @package namespace App\Entities;
 */
class BookVendor extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'book_vendor';
    protected $primaryKey = 'book_vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_vendor_id',
    	'book_id',
    	'vendor_id',
        'is_active'
    ];

    /**
     * Get the book record associated with the book vendor.
     */
    public function book()
    {
        return $this->belongsTo('App\Entities\Book', 'book_id');
    }

    /**
     * Get the vendor record associated with the book vendor.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Entities\Vendor', 'vendor_id');
    }
}
