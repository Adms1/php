<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable, AuditableContract
{
    use Auditable;
	use Notifiable;
    use TransformableTrait;
    protected $guard = 'user';
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'institution_id',
        'board_id',
        'standard_id',
    	'user_name',
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
}
