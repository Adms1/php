<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InstitutionBoardStandard.
 *
 * @package namespace App\Entities;
 */
class InstitutionBoardStandard extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'institution_board_standard';
	protected $primaryKey = 'institution_board_standard_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'institution_board_standard_id',
    	'institution_id',
        'board_id',
        'standard_id',
        'is_active',
    ];


    /**
     * InstitutionBoardStandard has institution.
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    /**
     * InstitutionBoardStandard has institution.
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }

    /**
     * InstitutionBoardStandard has institution.
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }

    /**
     * InstitutionBoardStandard has many Booksets.
     */
    public function ibsbookset()
    {
        return $this->hasMany(InstitutionBoardStandardBookset::class, 'institution_board_standard_id');
    }
}
