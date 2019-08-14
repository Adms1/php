<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class InstitutionBookVendorPrice.
 *
 * @package namespace App\Entities;
 */
class InstitutionBookVendorPrice extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'institution_book_vendor_price';
	protected $primaryKey = 'institution_book_vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'institution_book_vendor_id',
    	'institution_id',
        'book_id',
    	'vendor_id',
        'condition_id',
        'list_price',
        'sale_price',
        'is_active',
        'is_preffered',
    ];

    /**
     * The attributes that are mass assignable.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * The attributes that are mass assignable.
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    /**
     * The attributes that are mass assignable.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /**
     * The attributes that are mass assignable.
     */
    public function condition()
    {
        return $this->belongsTo(Condition::class, 'condition_id');
    }

}
