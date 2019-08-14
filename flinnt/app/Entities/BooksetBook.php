<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BooksetBook.
 *
 * @package namespace App\Entities;
 */
class BooksetBook extends Model implements Transformable
{
    use TransformableTrait;
	protected $table = 'book_set_book';
    protected $primaryKey = 'book_set_book_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_set_book_id',
    	'book_set_id',
    	'book_id',
    	'subject_id',
        'vendor_id',
    	'is_active'
    ];


    /**
     * Bookset has many books.
     */
    public function books()
    {
        return $this->belongsTo('Bookset', 'book_set_id');
    }
}
