<?php

namespace App\Repositories;

use App\Chapter;
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
        return BoardStandardSubjectChapterTopic::with(['topic'])
                                        ->where('BoardID', $board_id)
                                        ->where('StandardID', $standard_id)
                                        ->where('SubjectID', $subject_id)
                                        ->where('ChapterID', $chapter_id)
                                        ->get()
                                        ->pluck('topic.TopicName','topic.TopicID');
    }
}