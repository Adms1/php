<?php

namespace App\Repositories;

use App\Chapter;
use App\BoardStandardSubjectChapterTopic;
use Log;
use DB;

/**
 * Class ChapterRepository.
 *
 * @package namespace App\Repositories;
 */
class ChapterRepository
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
     * Get test chapter dropdoown.
     *
     * @param int $board_id
     * @param int $standard_id
     * @param int $subject_id
     * @return array $data
     */
    public function getChapterDropdown($board_id, $standard_id, $subject_id)
    {   
        // return BoardStandardSubjectChapterTopic::with(['chapter'])
        //             ->where('BoardID', $board_id)
        //             ->where('StandardID', $standard_id)
        //             ->where('SubjectID', $subject_id)
        //             ->where('IsActive', 1)
        //             ->distinct('ChapterName', 'ChapterID')
        //             // ->toSql();
        //             ->get()
        //             ->pluck('chapter.ChapterName','chapter.ChapterID');
        //             /*echo "<pre>";
        //             print_r($s);
        //             die;*/

        return BoardStandardSubjectChapterTopic::leftJoin('Chapter', 'Chapter.ChapterID', 'BoardStandardSubjectChapterTopic.ChapterID')
                    ->where('BoardStandardSubjectChapterTopic.IsActive', 1)
                    ->where('BoardID', $board_id)
                    ->where('StandardID', $standard_id)
                    ->where('SubjectID', $subject_id)
                    ->distinct('ChapterName', 'BoardStandardSubjectChapterTopic.ChapterID')
                    ->orderBy('ChapterName', 'ASC')
                    ->get()
                    ->pluck('ChapterName','ChapterID');
    }
}