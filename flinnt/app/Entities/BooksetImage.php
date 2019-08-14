<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BooksetImage.
 *
 * @package namespace App\Entities;
 */
class BooksetImage extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'book_set_image';
    protected $primaryKey = 'book_set_image_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_set_image_id',
    	'book_set_id',
    	'book_set_image_name',
        'book_set_image_path',
        'book_set_image_order',
        'is_primary',
        'is_active'
    ];
}
