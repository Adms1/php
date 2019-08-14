<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Board.
 *
 * @package namespace App\Entities;
 */
class Board extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'board';
	protected $primaryKey = 'board_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'board_id',
    	'board_name',
    	'is_active'
    ];


    /**
     * board has many InstitutionBoardStandard.
     */
    public function ibs()
    {
        return $this->hasMany(InstitutionBoardStandard::class, 'board_id');
    }
}
