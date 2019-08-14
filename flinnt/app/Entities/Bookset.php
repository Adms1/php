<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Entities\BooksetBook;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
/**
 * Class Bookset.
 *
 * @package namespace App\Entities;
 */
class Bookset extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
	protected $table = 'book_set';
    protected $primaryKey = 'book_set_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_set_id',
    	'institution_id',
    	'book_set_name',
    	'book_set_guid',
    	'is_active'
    ];


    /**
     * Bookset has institutionBoardStandardBookset.
     */
    public function ibsbookset()
    {
        return $this->hasOne(InstitutionBoardStandardBookset::class, 'book_set_id');
    }

    /**
     * Bookset has many books.
     */
    public function booksetbook()
    {
        return $this->hasMany(BooksetBook::class, 'book_set_id');
    }

    /**
     * Bookset has many books.
     */
    public function ibooksetvendorprice()
    {
        return $this->hasMany(InstitutionBooksetVendorPrice::class, 'book_set_id', 'book_set_id');
    }
}
