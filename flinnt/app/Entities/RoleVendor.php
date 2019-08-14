<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class RoleUser.
 *
 * @package namespace App\Entities;
 */
class RoleVendor extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'role_vendor';
	protected $primaryKey = 'role_vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_vendor_id',
    	'role_id',
    	'vendor_id'
    ];

}
