<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class OrderCourier.
 *
 * @package namespace App\Entities;
 */
class OrderCourier extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'order_courier';
	protected $primaryKey = 'order_courier_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_courier_id',
    	'order_id',
    	'courier_id',
        'user_id',
        'vendor_id',
    	'docket_number',
    	'status_id',
    	'send_at',
    	'deliver_at',
    ];

    /**
     * Get the order lines record associated with the order.
     */
    public function order()
    {
        return $this->belongsTo('App\Entities\Order', 'order_id');
    }

    /**
     * Get the courier record associated with the courier order.
     */
    public function courier()
    {
        return $this->belongsTo('App\Entities\Courier', 'courier_id');
    }

    /**
     * Get the vendor record associated with the courier order.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Entities\Vendor', 'vendor_id');
    }
}
