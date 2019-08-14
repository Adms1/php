<?php

namespace App\Repositories;

use App\CourseType;
use Log;
use DB;

/**
 * Class CourseTypeRepository.
 *
 * @package namespace App\Repositories;
 */
class CourseTypeRepository
{

    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Get resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            return CourseType::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('courseType list.',['CourseTypeRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store new resource.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        try {
            return CourseType::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('courseType store.',['CourseTypeRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $course_type_id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_type_id)
    {
        try {
            return CourseType::find($course_type_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('courseType edit.',['CourseTypeRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $course_type_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $course_type_id)
    {
        try {
            $course_types = CourseType::find($course_type_id);
            $course_types->fill($data);
            $course_types->save();
            return $course_types;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('courseType update.',['CourseTypeRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get course type dropdoown.
     *
     * @return array $data
     */
    public function getCourseTypeDropdown()
    {   
        return CourseType::pluck('CourseTypeName','CourseTypeID');
    }
}