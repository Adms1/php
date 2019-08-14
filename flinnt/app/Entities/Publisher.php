<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Publisher.
 *
 * @package namespace App\Entities;
 */
class Publisher extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
	protected $table = 'publisher';
    protected $primaryKey = 'publisher_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'publisher_id',
    	'publisher_name',
        'description',
        'is_active'
    ];

}
