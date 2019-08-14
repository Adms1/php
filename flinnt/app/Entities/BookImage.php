<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookImage.
 *
 * @package namespace App\Entities;
 */
class BookImage extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'book_image';
    protected $primaryKey = 'book_image_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_image_id',
    	'book_id',
    	'book_image_name',
        'book_image_path',
        'book_image_order',
        'is_primary',
        'is_active'
    ];
}
