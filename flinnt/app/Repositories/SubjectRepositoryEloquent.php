<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SubjectRepository;
use App\Validators\SubjectValidator;
use App\Entities\Subject;
use Log;

/**
 * Class SubjectRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubjectRepositoryEloquent extends BaseRepository implements SubjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subject::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return SubjectValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Delete subject by Id
     *
     * @param int $subject_id
     * @return array $subjects
     */
    public function deleteSubject($subject_id)
    {
        try {
            return Subject::where('subject_id',$subject_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete subject by Id.',['SubjectRepository/deleteSubject', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get subject list
     *
     * @return array $subjects
     */
    public function getSubjectList()
    {
        return Subject::where('is_active',1)->get();
    }
}