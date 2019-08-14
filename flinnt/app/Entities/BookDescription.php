<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookDescription.
 *
 * @package namespace App\Entities;
 */
class BookDescription extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'book_description';
    protected $primaryKey = 'book_description_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_description_id',
    	'book_id',
        'description',
        'description_order',
        'is_active'
    ];
}
