<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\BoardRepository;
use App\Repositories\TopicRepository;
use App\Repositories\ChapterRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\StandardRepository;
use App\Repositories\QuestionRepository;
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
        ChapterRepository $chapterRepository,
        SubjectRepository $subjectRepository,
        StandardRepository $standardRepository,
        QuestionRepository $questionRepository,
        QuestionTypeRepository $questionTypeRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->topicRepository = $topicRepository;
        $this->boardRepository = $boardRepository;
        $this->subjectRepository = $subjectRepository;
        $this->chapterRepository = $chapterRepository;
        $this->standardRepository = $standardRepository;
        $this->questionRepository = $questionRepository;
        $this->questionTypeRepository = $questionTypeRepository;
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
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        $question_types = $this->questionTypeRepository->getQuestionTypeList();
        return view('admin.question.create', compact('boards', 'question_types', 'dif_levels'));
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
        $question = $this->questionRepository->edit($id);
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
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
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
            
            default:
                $view = '';
                break;
        }
        
        return view('admin.question.edit', compact('question', 'answer', 'boards', 'standards', 'subjects', 'chapters', 'topics', 'dif_levels', 'question_types', 'board_id', 'standard_id', 'subject_id', 'chapter_id', 'topic_id', 'view'));
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
            
            default:
                $list = '';
                break;
        }
        return response()->json([
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
     
        $questions = $this->questionRepository->getSectionQuestionList($data['question_type_id'], $data['test_id']);
        // echo "<pre>";
        // echo "++++++++++++++";
        // print_r($list);
        // die;
        $list = view('partials.question', compact('questions'))->render();

        return response()->json([
            'list' => $list,
        ]);
    }
    
    /**
     * Store question by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function selectQuestion(Request $request)
    {
        $data = $request->all();
        echo "<pre>";
        print_r($data['queSelect']);
        die;
        $this->questionRepository->addQuestion($data);
        $questions = $this->questionRepository->getQuestionList($data['TestPackageTestID']);
        $list = view('partials.question', compact('questions'))->render();
        return response()->json([
            'list' => $list,
        ]);
    }
}
