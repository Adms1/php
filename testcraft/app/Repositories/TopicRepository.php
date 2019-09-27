<?php

namespace App\Repositories;

use App\Chapter;
use App\TestPackage;
use App\CourseSubjectTopic;
use App\BoardStandardSubjectChapterTopic;
use Log;
use DB;

/**
 * Class TopicRepository.
 *
 * @package namespace App\Repositories;
 */
class TopicRepository
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
     * Get test topic dropdoown.
     *
     * @param int $board_id
     * @param int $standard_id
     * @param int $subject_id
     * @param int $chapter_id
     * @return array $data
     */
    public function getTopicDropdown($board_id, $standard_id, $subject_id, $chapter_id)
    {   
        return BoardStandardSubjectChapterTopic::leftJoin('Topic', 'Topic.TopicID', 'BoardStandardSubjectChapterTopic.TopicID')
                    ->where('BoardStandardSubjectChapterTopic.IsActive', 1)
                    ->where('BoardID', $board_id)
                    ->where('StandardID', $standard_id)
                    ->where('SubjectID', $subject_id)
                    ->where('ChapterID', $chapter_id)
                    ->distinct('TopicName', 'BoardStandardSubjectChapterTopic.TopicID')
                    ->orderBy('TopicName', 'ASC')
                    ->get()
                    ->pluck('TopicName','TopicID');

    }

    /**
     * Get test topic dropdoown.
     *
     * @param int $subject_id
     * @param int $package_id
     * @return array $data
     */
    public function getTopicDropdownByCourse($subject_id, $package_id)
    {   
        $package_data = TestPackage::find($package_id);

        return CourseSubjectTopic::leftJoin('Topic', 'Topic.TopicID', 'CourseSubjectTopic.TopicID')
                    ->where('CourseSubjectTopic.IsActive', 1)
                    ->where('CourseID', $package_data->CourseID)
                    ->where('SubjectID', $subject_id)
                    ->distinct('TopicName', 'CourseSubjectTopic.TopicID')
                    ->orderBy('TopicName', 'ASC')
                    ->get()
                    ->pluck('TopicName','TopicID');

    }

    /**
     * Get test topic dropdoown.
     *
     * @param int $course_id
     * @param int $subject_id
     * @return array $data
     */
    public function getTopicListByCourseSubjectID($course_id, $subject_id)
    {   

        return CourseSubjectTopic::leftJoin('Topic', 'Topic.TopicID', 'CourseSubjectTopic.TopicID')
                    ->where('CourseSubjectTopic.IsActive', 1)
                    ->where('CourseID', $course_id)
                    ->where('SubjectID', $subject_id)
                    ->distinct('TopicName', 'CourseSubjectTopic.TopicID')
                    ->orderBy('TopicName', 'ASC')
                    ->get()
                    ->pluck('TopicName','TopicID');
    }


}