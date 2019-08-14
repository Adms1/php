<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Vendor.
 *
 * @package namespace App\Entities;
 */
class Admin extends Authenticatable
{
	use Notifiable;
    protected $guard = 'admin';
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
    	'admin_name',
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
}
