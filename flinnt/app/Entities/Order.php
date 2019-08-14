<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Order.
 *
 * @package namespace App\Entities;
 */
class Order extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'order';
	protected $primaryKey = 'order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id',
    	'user_id',
        'institution_id',
        'shipping_address_id',
    	'order_number',
    	'order_qty',
    	'order_total_price',
    	'transaction_id',
    	'payment_id',
    	'order_status',
    	'order_date',
    	'is_active',
    ];


    /**
     * Get the order lines record associated with the order.
     */
    public function orderline()
    {
        return $this->hasMany('App\Entities\OrderDetail', 'order_id');
    }

    /**
     * Get the order record associated with the order details.
     */
    public function institution()
    {
        return $this->belongsTo('App\Entities\Institution', 'institution_id');
    }

    /**
     * Get the order record associated with the order details.
     */
    public function useraddress()
    {
        return $this->belongsTo('App\Entities\UserAddress', 'shipping_address_id');
    }

    /**
     * Get the order courier record associated with the order.
     */
    public function ordercourier()
    {
        return $this->hasOne('App\Entities\OrderCourier', 'order_id');
    }
}
