<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Subject.
 *
 * @package namespace App\Entities;
 */
class Subject extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'subject';
	protected $primaryKey = 'subject_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'subject_id',
    	'subject_name',
    	'is_active'
    ];

    /**
     * board has many InstitutionBoardStandard.
     */
    public function ibss()
    {
        return $this->hasMany(InstitutionBoardStandardSubject::class, 'subject_id');
    }
}
