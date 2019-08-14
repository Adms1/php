<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookBoard.
 *
 * @package namespace App\Entities;
 */
class BookBoard extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'book_board';
    protected $primaryKey = 'book_board_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_board_id',
    	'book_id',
    	'board_id',
        'is_active'
    ];
}
