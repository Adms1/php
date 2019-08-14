<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class UserAddress.
 *
 * @package namespace App\Entities;
 */
class UserAddress extends Model implements Transformable, AuditableContract
{
    use Auditable;
	use TransformableTrait;
    protected $table = 'user_address';
    protected $primaryKey = 'user_address_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_address_id',
        'user_id',
        'fullname',
    	'address1',
        'address2',
    	'city',
    	'state_id',
    	'country_id',
        'pin',
    	'status_id',
        'address_type',
        'phone',
    	'is_active',
    ];

    /**
     * Get the order lines record associated with the order.
     */
    public function order()
    {
        return $this->hasMany('App\Entities\Order', 'user_address_id');
    }

    /**
     * Get the country record associated with the user address.
     */
    public function country()
    {
        return $this->belongsTo('App\Entities\Country', 'country_id');
    }

    /**
     * Get the state record associated with the user address.
     */
    public function state()
    {
        return $this->belongsTo('App\Entities\State', 'state_id');
    }
}
