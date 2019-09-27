<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\BoardRepository;
use App\Repositories\TopicRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ChapterRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\StandardRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\TestPackagesRepository;
use App\Repositories\QuestionTypeRepository;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Config;
use Lang;

class QuestionsController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var TopicRepository
     */
    protected $topicRepository;

    /**
     * @var ChapterRepository
     */
    protected $chapterRepository;

    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * @var BoardRepository
     */
    protected $boardRepository;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    /**
     * @var StandardRepository
     */
    protected $standardRepository;

    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * @var TestPackagesRepository
     */
    protected $testPackagesRepository;

    /**
     * @var QuestionTypeRepository
     */
    protected $questionTypeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseRepository $baseRepository,
        TopicRepository $topicRepository,
        BoardRepository $boardRepository,
        CourseRepository $courseRepository,
        ChapterRepository $chapterRepository,
        SubjectRepository $subjectRepository,
        StandardRepository $standardRepository,
        QuestionRepository $questionRepository,
        QuestionTypeRepository $questionTypeRepository,
        TestPackagesRepository $testPackagesRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->topicRepository = $topicRepository;
        $this->boardRepository = $boardRepository;
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->chapterRepository = $chapterRepository;
        $this->standardRepository = $standardRepository;
        $this->questionRepository = $questionRepository;
        $this->questionTypeRepository = $questionTypeRepository;
        $this->testPackagesRepository = $testPackagesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->list();
        return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boards = $this->boardRepository->getBSSCTBasedBoardDropdown();
        $courses = $this->courseRepository->getCSTBasedCourseDropdown();
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        $question_types = $this->questionTypeRepository->getQuestionTypeList();
        return view('admin.question.create', compact('boards', 'courses', 'question_types', 'dif_levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\QuestionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionStoreRequest $request)
    {
        $data = $request->all();
        /*echo "<pre>";
        print_r($data);*/
        $response = $this->questionRepository->store($data);
        
        if ($response) {
            return redirect()->route('questions.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('questions.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $boards = [];
        $standards = [];
        $subjects = [];
        $courses = [];
        $chapters = [];
        $board_id = '';
        $standard_id = '';
        $subject_id = '';
        $course_id = '';
        $chapter_id = '';

        $question = $this->questionRepository->edit($id);
        if ($question->DifficultyLevelID == 4) {
            //echo "--";
            // die;
            $course_id = $question->cstQuestion->cst->CourseID;
            $subject_id = $question->cstQuestion->cst->SubjectID;
            $topic_id = $question->cstQuestion->cst->TopicID;
            //echo "++";
            // die;
            $courses = $this->courseRepository->getCSTBasedCourseDropdown();
            $subjects = $this->subjectRepository->getSubjectListByCourseID($course_id);
            //echo "**";
            //die;
            $topics = $this->topicRepository->getTopicListByCourseSubjectID($course_id, $subject_id);
            //echo "()";
            //die;
            $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 1);
            //echo "===";
            //die;
        } else {
            $board_id = $question->bssctQuestion->bssct->BoardID;
            $standard_id = $question->bssctQuestion->bssct->StandardID;
            $subject_id = $question->bssctQuestion->bssct->SubjectID;
            $chapter_id = $question->bssctQuestion->bssct->ChapterID;
            $topic_id = $question->bssctQuestion->bssct->TopicID;

            $boards = $this->boardRepository->getBSSCTBasedBoardDropdown();
            $standards = $this->standardRepository->getStandardListByBoardID($board_id);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($board_id, $standard_id);
            $chapters = $this->chapterRepository->getChapterDropdown($board_id, $standard_id, $subject_id);
            $topics = $this->topicRepository->getTopicDropdown($board_id, $standard_id, $subject_id, $chapter_id);
            $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 0);
        }
        //die;
        $question_types = $this->questionTypeRepository->getQuestionTypeList();
        $answer = $this->questionRepository->getQuestionOptionAnswer($question->QuestionID, $question->QuestionTypeID);

        switch ($question->QuestionTypeID) {
            case '1':
                $view = view('partials.single_choice', compact('answer'))->render();
                break;
            
            case '2':
                $view = view('partials.fill_in_blank', compact('answer'))->render();
                break;

            case '4':
                $view = view('partials.true_false', compact('answer'))->render();
                break;

            case '7':
                $view = view('partials.multiple_choice', compact('answer'))->render();
                break;
            
            case '8':
                $view = view('partials.integer_type', compact('answer'))->render();
                break;

            default:
                $view = '';
                break;
        }
        
        return view('admin.question.edit', compact('question', 'answer', 'boards', 'standards', 'subjects', 'chapters', 'topics', 'dif_levels', 'question_types', 'board_id', 'standard_id', 'subject_id', 'chapter_id', 'topic_id', 'view', 'courses', 'course_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\QuestionUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $id)
    {
        $data = $request->all();

        $response = $this->questionRepository->update($data, $id);
        /*echo "<pre>";
        print_r($response);
        die;*/
        if ($response) {
            return redirect()->route('questions.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('questions.index')->with('error', Lang::get('admin.ca_update_failed'));
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
     * Get Question formate view by ajax and return
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionFormate(Request $request)
    {
        $data = $request->all();
     
        switch ($data['QuestionTypeID']) {
            case '1':
                $list = view('partials.single_choice')->render();
                break;
            
            case '2':
                $list = view('partials.fill_in_blank')->render();
                break;

            case '4':
                $list = view('partials.true_false')->render();
                break;

            case '7':
                $list = view('partials.multiple_choice')->render();
                break;

            case '8':
                $list = view('partials.integer_type')->render();
                break;
            
            default:
                $list = '';
                break;
        }
        return response()->json([
            'success' => true,
            'list' => $list,
        ]);
    }

    /**
     * Get Question formate view by ajax and return
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSectionQuestionList(Request $request)
    {
        $data = $request->all();
        $section_info = $this->questionRepository->getSectionInfo($data['TestSectionQuestionTypeID']);
        /*echo "<pre>";
        print_r($section_info->toArray());
        die;*/
        $selected_que = $this->questionRepository->getSelectedSectionQuestionList($data['TestSectionQuestionTypeID'], $data['TestPackageTestID']);
        $questions = $this->questionRepository->getSectionQuestionList($data['QuestionTypeID'], $data['TestPackageTestID'], $selected_que);
        /*echo "<pre>";
        echo "++++++++++++++";
        print_r($data);
        die;*/
        $list = view('partials.question', compact('questions', 'data'))->render();

        return response()->json([
            'success' => true,
            'list' => $list,
            'section_info' => $section_info,
            'selected_que_count' => $selected_que->count(),
        ]);
    }
    
    /**
     * Store question by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addSelectedQuestion(Request $request)
    {
        $data = $request->all();
        //print_r($data['QuestionID']);
        $section_info = $this->questionRepository->getSectionInfo($data['TestSectionQuestionTypeID']);
        $selected_que = $this->questionRepository->getSelectedSectionQuestionList($data['TestSectionQuestionTypeID'], $data['TestPackageTestID']);
        /*echo "<pre>";
        print_r($selected_que->count());
        echo "-----------";
        print_r($data['QuestionID']->count());*/
        //die;
        if ($section_info['NumberofQuestion'] < $selected_que->count() + count($data['QuestionID'])) {
            return response()->json([
                'error' => true,
                'message' => 'Selected Questions do not Equate with Total Questions. Please Check Again',
            ]);
        }
        /*echo "<pre>";
        print_r($data);
        die;*/
        $this->questionRepository->addSelectedQuestion($data);
        $section_info = $this->questionRepository->getSectionInfo($data['TestSectionQuestionTypeID']);
        $selected_que = $this->questionRepository->getSelectedSectionQuestionList($data['TestSectionQuestionTypeID'], $data['TestPackageTestID']);
        $questions = $this->questionRepository->getSectionQuestionList($data['QuestionTypeID'], $data['TestPackageTestID'], $selected_que);
        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);

        $test_detail = $this->testPackagesRepository->getTest($data['TestPackageTestID']);
        $test_package = $this->testPackagesRepository->edit($test_detail->TestPackageID);
        if ($test_package->IsAutoTestCreation == 1) {
            $section_view = view('partials.section_auto', compact('sections'))->render();
        } else {
            $section_view = view('partials.section', compact('sections'))->render();
        }

        $question_view = view('partials.question', compact('questions', 'data'))->render();
        return response()->json([
            'success' => true,
            'question_view' => $question_view,
            'section_view' => $section_view,
            'section_info' => $section_info,
            'selected_que_count' => $selected_que->count(),
            'request' => $data,
        ]);
    }

    /**
     * Delete selected question by ajax and return view
     *
     * @param  Illuminate\HtaddSelectedQuestion\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSelectedQuestion(Request $request)
    {
        $data = $request->all();
     
        $this->questionRepository->deleteSelectedQuestion($data['TestQuestionManualID']);
        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);

        $test_detail = $this->testPackagesRepository->getTest($data['TestPackageTestID']);
        $test_package = $this->testPackagesRepository->edit($test_detail->TestPackageID);
        if ($test_package->IsAutoTestCreation == 1) {
            $list = view('partials.section_auto', compact('sections'))->render();
        } else {
            $list = view('partials.section', compact('sections'))->render();
        }

        $list = view('partials.section', compact('sections'))->render();
        return response()->json([
            'success' => true,
            'list' => $list,
        ]);
    }

    /**
     * get Question by ajax
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionByAjax(Request $request)
    {
        $data = $request->all();
        $question = $this->questionRepository->edit($data['QuestionID']);
        /*echo "<pre>";
        print_r($question->toArray());
        die;*/
        return response()->json([
            'success' => true,
            'question' => $question,
        ]);
    }

    /**
     * return data of the simple datatables.
     *
     * @param  Illuminate\Http\Request $request
     * @return Json
     */
    public function getDatatablesData(Request $request)
    {
        $data = $request->all();
        $selected_que = $this->questionRepository->getSelectedSectionQuestionList($data['TestSectionQuestionTypeID'], $data['TestPackageTestID']);
        return $this->questionRepository->getDatatablesData($data['QuestionTypeID'], $data['TestPackageTestID'], $selected_que);
    }

    /**
     * get Difficulty Level by test type
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getDifficultyByAjax(Request $request)
    {
        $data = $request->all();
        $diff_level = $this->baseRepository->getDifficultyByAjax($data['IsCompetetive']);
        return response()->json([
            'success' => true,
            'data' => $diff_level,
        ]);
    }
}
