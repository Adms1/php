<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\TopicRepository;
use Config;
use Lang;

class TopicsController extends Controller
{
    /**
     * @var TopicRepository
     */
    protected $topicRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    /**
     * Get topic list based on board, standard, subject, chapter OR course, subject
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_ajaxget(Request $request)
    {
        $topics = [];
        $board_standard_subject_validator = Validator::make($request->all(), [
            'board_id' => 'required',
            'standard_id' => 'required',
            'subject_id' => 'required',
            'chapter_id' => 'required',
        ]);
        
        $course_validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'subject_id' => 'required',
        ]);

        if ($board_standard_subject_validator->passes()) {
            $board_id = $request->board_id;
            $standard_id = $request->standard_id;
            $subject_id = $request->subject_id;
            $chapter_id = $request->chapter_id;
            // Get Topic list by board, standard, subject, chapter
            $topics = $this->topicRepository->getTopicDropdown($board_id, $standard_id, $subject_id, $chapter_id);
        } else if ($course_validator->passes()) {
            $course_id = $request->course_id;
            $subject_id = $request->subject_id;
            // Get Topic list by course, subject
            $topics = $this->topicRepository->getTopicListByCourseSubjectID($course_id, $subject_id);
        } else {
            return response()->json([
                'error'   => true,
                'message' => $course_validator->errors()
            ]);
        }

        return response()->json([
            'success' => true,
            'data'  => $topics,
        ]);
    }

    /**
     * Get topic list based on course
     *
     * @return \Illuminate\Http\Response
     */
    public function topicByCourse_ajaxget(Request $request)
    {
        $subject_id = $request->subject_id;
        $id = $request->id;

        $topics = $this->topicRepository->getTopicDropdownByCourse($subject_id, $id);

        return response()->json([
            'success' => true,
            'data'  => $topics,
        ]);
    }
}
