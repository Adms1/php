<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Author.
 *
 * @package namespace App\Entities;
 */
class Author extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;
	protected $table = 'author';
    protected $primaryKey = 'author_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'author_id',
    	'author_name',
        'about_author',
        'is_active'
    ];


    /**
     * Author has many book.
     */
    public function books()
    {
        return $this->hasMany(BookAuthor::class, 'book_id', 'author_id');
    }
}
