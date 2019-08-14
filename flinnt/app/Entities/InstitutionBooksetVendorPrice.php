<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class InstitutionBooksetVendorPrice.
 *
 * @package namespace App\Entities;
 */
class InstitutionBooksetVendorPrice extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'institution_bookset_vendor_price';
	protected $primaryKey = 'institution_book_set_vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'institution_book_set_vendor_id',
    	'institution_id',
        'book_set_id',
    	'vendor_id',
        'condition_id',
        'list_price',
        'sale_price',
        'is_active',
        'is_preffered',
    ];

    /**
     * InstitutionBoardStandard has institution.
     */
    public function ibsbookset()
    {
        return $this->belongsTo(InstitutionBoardStandardBookset::class, 'book_set_id', 'book_set_id');
    }

    /**
     * InstitutionBoardStandard has institution.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /**
     * InstitutionBooksetVendorPrice has bookset.
     */
    public function bookset()
    {
        return $this->belongsTo(Bookset::class, 'book_set_id', 'book_set_id');
    }

}
