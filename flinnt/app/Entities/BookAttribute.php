<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class BookAttribute.
 *
 * @package namespace App\Entities;
 */
class BookAttribute extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'book_attribute';
    protected $primaryKey = 'book_attribute_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_attribute_id',
    	'book_id',
    	'attribute_id',
        'attribute_value',
        'is_active'
    ];
}
