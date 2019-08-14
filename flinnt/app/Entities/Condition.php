<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Board.
 *
 * @package namespace App\Entities;
 */
class Condition extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'condition';
	protected $primaryKey = 'condition_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'condition_id',
    	'condition_name',
    	'is_active'
    ];

}
