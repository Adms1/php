<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class BookCategoryTree.
 *
 * @package namespace App\Entities;
 */
class BookCategoryTree extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'book_category_tree';
    protected $primaryKey = 'book_category_tree_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_category_tree_id',
    	'book_id',
    	'category_tree_id',
        'is_active'
    ];
}
