<?php

namespace App\Repositories;

use Log;
use DB;
use App\CourseSubject;

/**
 * Class CourseSubjectRepository.
 *
 * @package namespace App\Repositories;
 */
class CourseSubjectRepository
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
            return CourseSubject::with(['course', 'subject'])->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course subject list.',['CourseSubjectRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store new resource.
     *
     * @param array $data
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        try {
            return CourseSubject::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course subject store.',['CourseSubjectRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $course_subject_id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_subject_id)
    {
        try {
            return CourseSubject::find($course_subject_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course subject edit.',['CourseSubjectRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $course_subject_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $course_subject_id)
    {
        try {
            $course_subject = CourseSubject::find($course_subject_id);
            $course_subject->fill($data);
            $course_subject->save();
            return $course_subject;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('course subject update.',['CourseSubjectRepository/update', $e->getMessage()]);
            return false;
        }
    }
}