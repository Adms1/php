<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class OrderDetail.
 *
 * @package namespace App\Entities;
 */
class OrderDetail extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'order_detail';
	protected $primaryKey = 'order_detail_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_detail_id',
    	'order_id',
    	'product_id',
        'vendor_id',
    	'product_name',
    	'product_type',
    	'sale_price',
    	'qty',
    	'discount_id',
    	'discount_price',
    	'final_price',
    ];

    /**
     * Get the order record associated with the order details.
     */
    public function order()
    {
        return $this->belongsTo('App\Entities\Order', 'order_id');
    }

    /**
     * Get the order record associated with the order details.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Entities\Vendor', 'vendor_id');
    }
}
