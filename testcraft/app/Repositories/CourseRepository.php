<?php

namespace App\Repositories;

use App\Course;
use Log;
use DB;

/**
 * Class CourseRepository.
 *
 * @package namespace App\Repositories;
 */
class CourseRepository
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
            return Course::with('courseType')->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course list.',['CourseRepository/list', $e->getMessage()]);
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
            return Course::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course store.',['CourseRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $course_id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id)
    {
        try {
            return Course::find($course_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course edit.',['CourseRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $course_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $course_id)
    {
        try {
            $course = Course::find($course_id);
            $course->fill($data);
            $course->save();
            return $course;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course update.',['CourseRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get course dropdoown.
     *
     * @return array $data
     */
    public function getCourseDropdown()
    {   
        return Course::pluck('CourseName','CourseID');
    }
}