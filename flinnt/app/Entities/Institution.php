<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Institution.
 *
 * @package namespace App\Entities;
 */
class Institution extends Authenticatable implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $guard = 'institution';
    protected $table = 'institution';
	protected $primaryKey = 'institution_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'institution_id',
    	'institution_name',
        'contact_name',
        'email',
        'password',
        'remember_token',
        'address1',
        'address2',
        'city',
        'state_id',
        'country_id',
        'pin',
        'status_id',
        'phone',
        'institution_image',
        'is_active',
        'email_verified_at'
    ];


    /**
     * Get the order lines record associated with the order.
     */
    public function order()
    {
        return $this->hasMany('App\Entities\Order', 'order_id');
    }

    /**
     * Get the country record associated with the institution.
     */
    public function country()
    {
        return $this->belongsTo('App\Entities\Country', 'country_id');
    }

    /**
     * Get the state record associated with the state.
     */
    public function state()
    {
        return $this->belongsTo('App\Entities\State', 'state_id');
    }

    /**
     * Get the status record associated with the status.
     */
    public function status()
    {
        return $this->belongsTo('App\Entities\Status', 'status_id');
    }
}
