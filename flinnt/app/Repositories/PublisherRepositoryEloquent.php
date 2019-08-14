<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PublisherRepository;
use App\Validators\PublisherValidator;
use App\Entities\Publisher;
use Log;

/**
 * Class PublisherRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PublisherRepositoryEloquent extends BaseRepository implements PublisherRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Publisher::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return PublisherValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
 
    /**
     * Create publisher
     *
     * @param array $data
     * @return array $publisher
     */
    public function createPublisher($data)
    {
        try {
            $publisher = new Publisher();
            $publisher->fill($data);
            $publisher->save();
            return $publisher;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create publisher.',['PublisherRepository/createPublisher', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update publisher
     *
     * @param array $data
     * @param int $publisher_id
     * @return array $publisher
     */
    public function updatePublisher($data, $publisher_id)
    {
        try {
            $publisher = Publisher::find($publisher_id);
            $publisher->fill($data);
            $publisher->save();
            return $publisher;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update publisher.',['PublisherRepository/updatePublisher', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete publisher by Id
     *
     * @param int $publisher_id
     * @return array $publishers
     */
    public function deletePublisher($publisher_id)
    {
        try {
            return Publisher::where('publisher_id',$publisher_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete publisher by Id.',['PublisherRepository/deletePublisher', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get publisher list
     *
     * @return array $publishers
     */
    public function getPublisherList()
    {
        return Publisher::where('is_active',1)->get();
    }
}