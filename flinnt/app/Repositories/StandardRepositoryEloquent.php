<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StandardRepository;
use App\Validators\StandardValidator;
use App\Entities\Standard;
use Log;

/**
 * Class StandardRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StandardRepositoryEloquent extends BaseRepository implements StandardRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Standard::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return StandardValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Delete standard by Id
     *
     * @param int $standard_id
     * @return array $standards
     */
    public function deleteStandard($standard_id)
    {
        try {
            return Standard::where('standard_id',$standard_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete standard by Id.',['StandardRepository/deleteStandard', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get standard list
     *
     * @return array $standards
     */
    public function getStandardList()
    {
        return Standard::where('is_active',1)->get();
    }
}
