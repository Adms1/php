<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InstitutionVendor.
 *
 * @package namespace App\Entities;
 */
class InstitutionVendor extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'institution_vendor';
	protected $primaryKey = 'institution_vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'institution_vendor_id',
    	'institution_id',
        'vendor_id',
    ];

   /**
     * Get the institution record associated with the institution_vendor details.
     */
    public function institution()
    {
        return $this->belongsTo('App\Entities\Institution', 'institution_id');
    }

    /**
     * Get the vendor record associated with the institution_vendor details.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Entities\Vendor', 'vendor_id');
    }

}
