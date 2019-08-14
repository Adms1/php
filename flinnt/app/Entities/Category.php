<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Category.
 *
 * @package namespace App\Entities;
 */
class Category extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'category_id',
    	'category_name',
    	'category_image',
    	'is_active'
    ];


    /**
     * Category has many parent.
     */
    public function childrenCategory()
    {
        return $this->hasMany(ParentCategoryBrg::class, 'parent_id', 'category_id');
    }

}
