<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BooksetDescription.
 *
 * @package namespace App\Entities;
 */
class BooksetDescription extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'book_set_description';
    protected $primaryKey = 'book_set_description_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_set_description_id',
    	'book_set_id',
        'description',
        'description_order',
        'is_active'
    ];
}
