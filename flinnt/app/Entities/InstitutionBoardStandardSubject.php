<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InstitutionBoardStandardSubject.
 *
 * @package namespace App\Entities;
 */
class InstitutionBoardStandardSubject extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'institution_board_standard_subject';
	protected $primaryKey = 'institution_board_standard_subject_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'institution_board_standard_subject_id',
    	'institution_id',
        'board_id',
        'standard_id',
        'subject_id',
        'is_active',
    ];

    /**
     * InstitutionBoardStandardSubject has institution.
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    /**
     * InstitutionBoardStandardSubject has board.
     */
    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }

    /**
     * InstitutionBoardStandardSubject has standard.
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }

    /**
     * InstitutionBoardStandardSubject has subject.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
