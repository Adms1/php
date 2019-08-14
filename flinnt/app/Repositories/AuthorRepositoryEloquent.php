<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AuthorRepository;
use App\Validators\AuthorValidator;
use App\Entities\BookAuthor;
use App\Entities\Author;
use Log;

/**
 * Class AuthorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AuthorRepositoryEloquent extends BaseRepository implements AuthorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Author::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return AuthorValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Create author
     *
     * @param array $data
     * @return array $author
     */
    public function createAuthor($data)
    {
        try {
            $author = new Author();
            $author->fill($data);
            $author->save();
            return $author;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create author.',['AuthorRepository/createAuthor', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update author
     *
     * @param array $data
     * @param int $author_id
     * @return array $authors
     */
    public function updateAuthor($data, $author_id)
    {
        try {
            $author = Author::find($author_id);
            $author->fill($data);
            $author->save();
            return $author;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update author.',['AuthorRepository/updateAuthor', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete author by Id
     *
     * @param int $author_id
     * @return array $authors
     */
    public function deleteAuthor($author_id)
    {
        try {
            return Author::where('author_id',$author_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete author by Id.',['AuthorRepository/deleteAuthor', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get author by book Id
     *
     * @param array $book_ids
     * @return array $authors
     */
    public function getAuthorsBasedOnProducts($book_ids)
    {
        // echo "<pre>";
        // $book = BookAuthor::leftjoin('author', 'author.author_id', '=', 'book_author.author_id')
        //             ->whereIn('book_author.book_id', $book_ids)->pluck('author.author_name','author.author_id');

        return BookAuthor::with(['author'])
                    ->whereIn('book_id', $book_ids)
                    ->get()
                    ->pluck('author.author_name', 'author_id');
    }

    /**
     * Get author by book Id
     *
     * @param  array $author_ids
     * @return array $authors
     */
    public function getAuthorsByAuthorIds($author_ids)
    {
        return Author::whereIn('author_id',$author_ids)->pluck('author_name');
    }

     /**
     * Get author list
     *
     * @return array $authors
     */
    public function getAuthorList()
    {
        return Author::where('is_active',1)->get();
    }
}