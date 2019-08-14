<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Book.
 *
 * @package namespace App\Entities;
 */
class Book extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
    protected $table = 'book';
	protected $primaryKey = 'book_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_id',
    	'publisher_id',
    	'covertype_id',
    	'language_id',
        'subject_id',
    	'book_name',
    	'isbn',
    	'series',
        'formate',
    	'book_guid',
    	'hs_code',
    	'is_active',
    	'is_academic',
    	'book_width',
    	'book_lenght',
    	'book_height'
    ];

    /**
     * The book images that are mass assignable.
     */
    public function bookImage()
    {
        return $this->hasMany(BookImage::class, 'book_id');
    }

    /**
     * The board that are mass assignable.
     */
    public function board()
    {
        return $this->belongsToMany(Board::class, 'book_board', 'book_id', 'board_id');
    }

    /**
     * Get the standard record associated with book.
     */
    public function standard()
    {
        return $this->belongsToMany(Standard::class, 'book_standard', 'book_id', 'standard_id');
    }

    /**
     * Get the subject record associated with book.
     */
    public function subject()
    {
        return $this->belongsTo('App\Entities\Subject', 'subject_id');
    }

    /**
     * Get the publisher record associated with the book.
     */
    public function publisher()
    {
        return $this->belongsTo('App\Entities\Publisher', 'publisher_id');
    }

    /**
     * Get the vendor record associated with the book.
     */
    public function bookvendor()
    {
        return $this->belongsToMany('App\Entities\Vendor', 'book_vendor', 'book_id', 'vendor_id');
    }
    
    /**
     * Get the language record associated with book.
     */
    public function language()
    {
        return $this->belongsTo('App\Entities\Language', 'language_id');
    }
}
