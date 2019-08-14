<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ParentCategoryBrg.
 *
 * @package namespace App\Entities;
 */
class ParentCategoryBrg extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'category_tree';
    protected $primaryKey = 'category_tree_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'category_tree_id',
    	'child_category_id',
    	'parent_category_id'
    ];

    /**
     * Category has many child.
     */
    public function childCategory()
    {
        return $this->belongsTo(Category::class, 'child_category_id', 'category_id');
    }

}
