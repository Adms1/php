<?php

namespace App\Repositories;

use App\Subject;
use App\CourseSubject;
use App\CourseSubjectTopic;
use App\BoardStandardSubjectChapterTopic;
use Log;
use DB;

/**
 * Class SubjectRepository.
 *
 * @package namespace App\Repositories;
 */
class SubjectRepository
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
            return Subject::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('subject list.',['SubjectRepository/list', $e->getMessage()]);
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
            return Subject::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('subject store.',['SubjectRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $subject_id
     * @return \Illuminate\Http\Response
     */
    public function edit($subject_id)
    {
        try {
            return Subject::find($subject_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('subject edit.',['SubjectRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by subject_id.
     *
     * @param array $data
     * @param int $subject_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $subject_id)
    {
        try {
            $subject = Subject::find($subject_id);
            $subject->fill($data);
            $subject->save();
            return $subject;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('subject update.',['SubjectRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get subject dropdoown.
     *
     * @return array $data
     */
    public function getSubjectDropdown()
    {   
        return Subject::where('IsActive', 1)->pluck('SubjectName','SubjectID');
    }

    /**
     * Get resource for subject list by course id.
     *
     * @param int $course_id
     * @return \Illuminate\Http\Response
     */
    public function getSubjectListByCourseID($course_id)
    {
        try {
            return CourseSubjectTopic::leftJoin('Subject', 'Subject.SubjectID', 'CourseSubjectTopic.SubjectID')
                    ->where('CourseSubjectTopic.IsActive', 1)
                    ->where('CourseID', $course_id)
                    ->distinct('SubjectName', 'BoardStandardSubjectChapterTopic.SubjectID')
                    ->orderBy('SubjectName', 'ASC')
                    ->get()
                    ->pluck('SubjectName','SubjectID');


        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('subject list by ajax.',['SubjectRepository/getSubjectListByCourse', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for subject list by board_id, standard_id.
     *
     * @param int $board_id
     * @param int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function getSubjectListByBoardStandardID($board_id, $standard_id)
    {
        try {
            return BoardStandardSubjectChapterTopic::leftJoin('Subject', 'Subject.SubjectID', 'BoardStandardSubjectChapterTopic.SubjectID')
                    ->where('BoardStandardSubjectChapterTopic.IsActive', 1)
                    ->where('BoardID', $board_id)
                    ->where('StandardID', $standard_id)
                    ->distinct('SubjectName', 'BoardStandardSubjectChapterTopic.SubjectID')
                    ->orderBy('SubjectName', 'ASC')
                    ->get()
                    ->pluck('SubjectName','SubjectID');

        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('subject list by ajax.',['SubjectRepository/getSubjectListByBoardStandard', $e->getMessage()]);
            return false;
        }
    }
}