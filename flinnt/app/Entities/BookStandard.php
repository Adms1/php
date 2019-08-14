<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookStandard.
 *
 * @package namespace App\Entities;
 */
class BookStandard extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'book_standard';
    protected $primaryKey = 'book_standard_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_standard_id',
    	'book_id',
    	'standard_id',
        'is_active'
    ];
}
