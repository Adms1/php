<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Vendor.
 *
 * @package namespace App\Entities;
 */
class Vendor extends Authenticatable implements Transformable, AuditableContract
{
    use Auditable;
	use Notifiable;
    use TransformableTrait;
    protected $guard = 'vendor';
    protected $table = 'vendor';
    protected $primaryKey = 'vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id',
    	'vendor_name',
    	'email',
    	'password',
    	'remember_token',
    	'vendor_address1',
        'vendor_address2',
    	'vendor_city',
    	'vendor_state_id',
    	'vendor_country_id',
        'vendor_pin',
    	'vendor_status_id',
    	'vendor_gst_number',
        'flint_charge',
        'vendor_phone',
    	'is_active',
    	'email_verified_at'
    ];

    /**
     * array $roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_vendor', 'vendor_id', 'role_id');
    }

    /**
     * @param array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || 
            abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('role_name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('role_name', $role)->first();
    }

    /**
     * Get the country record associated with the vendor.
     */
    public function country()
    {
        return $this->belongsTo('App\Entities\Country', 'vendor_country_id');
    }

    /**
     * Get the country record associated with the vendor.
     */
    public function state()
    {
        return $this->belongsTo('App\Entities\State', 'vendor_state_id');
    }

    /**
     * Get the country record associated with the vendor.
     */
    public function status()
    {
        return $this->belongsTo('App\Entities\Status', 'vendor_status_id');
    }

    /**
     * Get the institution record associated with the vendor.
     */
    public function orderline()
    {
        return $this->hasMany('App\Entities\OrderDetail', 'order_id');
    }
}
