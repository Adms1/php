<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Courier.
 *
 * @package namespace App\Entities;
 */
class Courier extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'courier';
    protected $primaryKey = 'courier_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'courier_id',
    	'courier_name',
    	'tracking_url',
    	'is_active'
    ];

    /**
     * Get the order courier record associated with the order.
     */
    public function ordercourier()
    {
        return $this->hasOne('App\Entities\OrderCourier', 'order_id');
    }
}
