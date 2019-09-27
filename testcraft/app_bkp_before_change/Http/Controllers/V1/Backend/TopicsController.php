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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get topic list based on board, standard, subject, chapter
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

            $topics = $this->topicRepository->getTopicDropdown($board_id, $standard_id, $subject_id, $chapter_id);
        } else if ($course_validator->passes()) {
            $course_id = $request->course_id;
            $subject_id = $request->subject_id;
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
