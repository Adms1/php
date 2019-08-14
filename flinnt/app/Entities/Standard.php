<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Standard.
 *
 * @package namespace App\Entities;
 */
class Standard extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'standard';
	protected $primaryKey = 'standard_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'standard_id',
    	'standard_name',
    	'is_active'
    ];


    /**
     * board has many InstitutionBoardStandard.
     */
    public function ibs()
    {
        return $this->hasMany(InstitutionBoardStandard::class, 'standard_id');
    }
}
