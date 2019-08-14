<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InstitutionBoardStandardBookset.
 *
 * @package namespace App\Entities;
 */
class InstitutionBoardStandardBookset extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'institution_board_standard_bookset';
	protected $primaryKey = 'institution_board_standard_bookset_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'institution_board_standard_bookset_id',
    	'institution_board_standard_id',
        'book_set_id',
        'is_active',
    ];

    /**
     * institutionBoardStandardBookset has InstitutionBoardStandard.
     */
    public function ibs()
    {
        return $this->belongsTo(InstitutionBoardStandard::class, 'institution_board_standard_id');
    }

    /**
     * institutionBoardStandardBookset has Bookset.
     */
    public function bookset()
    {
        return $this->belongsTo(Bookset::class, 'book_set_id');
    }

    /**
     * InstitutionBoardStandardBookset has many InstitutionBooksetVendorPrice
     */
    public function ibooksetvendorprice()
    {
        return $this->hasMany(InstitutionBooksetVendorPrice::class, 'book_set_id', 'book_set_id');
    }
}
