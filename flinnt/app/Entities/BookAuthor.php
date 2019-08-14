<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Entities\Author;

/**
 * Class BookAuthor.
 *
 * @package namespace App\Entities;
 */
class BookAuthor extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'book_author';
    protected $primaryKey = 'book_author_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'book_author_id',
    	'book_id',
    	'author_id',
        'is_active'
    ];

    /**
     * Book has many author.
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
