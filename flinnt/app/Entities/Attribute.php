<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Attribute.
 *
 * @package namespace App\Entities;
 */
class Attribute extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'attribute';
	protected $primaryKey = 'attribute_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'attribute_id',
    	'attribute_name',
    	'product_type',
    	'is_active',
    ];

    public function generateTags(): array
    {
        return [
            $this->attribute_name
        ];
    }

}
