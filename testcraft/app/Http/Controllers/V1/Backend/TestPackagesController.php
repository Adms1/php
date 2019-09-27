<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\BoardRepository;
use App\Repositories\CourseRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\StandardRepository;
use App\Repositories\TestTypeRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\TestPackagesRepository;
use App\Repositories\QuestionTypeRepository;
use App\Http\Requests\TestPackageStoreRequest;
use App\Http\Requests\TestPackageUpdateRequest;
use Config;
use Lang;

class TestPackagesController extends Controller
{
    /**
     * @var StandardRepository
     */
    protected $standardRepository;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * @var TestTypeRepository
     */
    protected $testTypeRepository;

    /**
     * @var BoardRepository
     */
    protected $boardRepository;

    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * @var QuestionTypeRepository
     */
    protected $questionTypeRepository;

    /**
     * @var TestPackagesRepository
     */
    protected $testPackagesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseRepository $baseRepository,
        BoardRepository $boardRepository,
        CourseRepository $courseRepository,
        SubjectRepository $subjectRepository,
        StandardRepository $standardRepository,
        TestTypeRepository $testTypeRepository,
        QuestionRepository $questionRepository,
        QuestionTypeRepository $questionTypeRepository,
        TestPackagesRepository $testPackagesRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->boardRepository = $boardRepository;
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->standardRepository = $standardRepository;
        $this->testTypeRepository = $testTypeRepository;
        $this->questionRepository = $questionRepository;
        $this->testPackagesRepository = $testPackagesRepository;
        $this->questionTypeRepository = $questionTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test_packages = $this->testPackagesRepository->list();
        return view('admin.test_package.index', compact('test_packages'));
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
        return view('admin.test_package.create', compact('boards', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TestPackageStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestPackageStoreRequest $request)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='package');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.PACKAGE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        // Create new test package and redirect to next tab
        $response = $this->testPackagesRepository->store($data);
        if ($response) {
            return redirect()->route('testPackages.edit', [$response['TestPackageID'], 'tab' => 'test'])
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('testPackages.index')->with('error', Lang::get('admin.ca_create_failed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test_package = $this->testPackagesRepository->getTestPackageDetail($id);
        return view('admin.test_package.view', compact('test_package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = [];
        $standards = [];

        $test_package = $this->testPackagesRepository->edit($id);
        // If test package is academic
        if ($test_package->IsCompetetive == 0) {
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
        }

        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $boards = $this->boardRepository->getBSSCTBasedBoardDropdown();
        $courses = $this->courseRepository->getCSTBasedCourseDropdown();
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();

        // Get all tests related to test package
        $tests = $this->testPackagesRepository->getTests($id);

        // Count remaining number of tests related to test package
        $remain = $this->testPackagesRepository->getCountOfRemainNumberOfTest($id);

        return view('admin.test_package.edit', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'remain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TestPackageUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestPackageUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='package');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.PACKAGE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        // Check if all the tests have been published related to test package else show message
        if ($data['StatusID'] == 9 ) { // 9 - Published
            $result = $this->testPackagesRepository->checkToPublishTestPackage($id);
            if ($result != 0) {
                return redirect()->route('testPackages.edit', $id)->with('error', Lang::get('admin.ca_testpackage_publish_failed'));
            }
        }
        // Update test package
        $response = $this->testPackagesRepository->update($data, $id);
        if ($response) {
            return redirect()->route('testPackages.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('testPackages.index')
                ->with('error', Lang::get('admin.ca_update_failed'));
    }

    /**
     * Display view to create test
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function testCreate($id)
    {
        $subjects = [];
        $standards = [];

        // Get Test Package Detail
        $test_package = $this->testPackagesRepository->edit($id);

        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $question_types = $this->questionTypeRepository->getQuestionTypeDropdown();

        // Get Difficulty level dropdown for campetetive 
        $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 1);
        
        // Get all tests related to test package
        $tests = $this->testPackagesRepository->getTests($id);

        if ($test_package->IsCompetetive == 0) { // Academic
            $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 0);
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
            return view('admin.test_package.test_create', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types'));
        }

        // Get subject dropdown for campetetive
        $subjects = $this->subjectRepository->getSubjectListByCourseID($test_package->CourseID);
        return view('admin.test_package.competitive_test_create', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types'));
    }

    /**
     * Store Test by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function testStore(Request $request)
    {
        $data = $request->all();
        $test = $this->testPackagesRepository->testStore($data);
        return redirect()->route('test_edit', [$test['TestPackageID'], $test['TestPackageTestID']])
                ->with('success', Lang::get('admin.ca_create_successfully'));
    }

    /**
     * Display view to update test
     *
     * @param  int $id
     * @param  int $test_id
     * @return \Illuminate\Http\Response
     */
    public function testEdit($id, $test_id)
    {
        $subjects = [];
        $standards = [];

        // Get Test Package Detail
        $test_package = $this->testPackagesRepository->edit($id);

        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        
        // Get Difficulty level dropdown for campetetive 
        $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 1);

        // Get all tests related to test package
        $tests = $this->testPackagesRepository->getTests($id);

        // Get test detail
        $test = $this->testPackagesRepository->getTest($test_id);

        // Get count of total marks and questions
        $count_data = $this->testPackagesRepository->countMarkQuestion($test_id);
        $total_marks = array_sum(array_column($count_data, 'TotalSecMarks'));
        $remain_marks = $test['TestMarks'] - $total_marks;

        // Get count of remain questions groupby queation type
        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($test_id);
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        if ($test_package->IsCompetetive == 0) { // Academic

            // Get Assigned chapter topic list related to test
            $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($test['TestPackageTestID']);
            $assigned_view = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();

            // Get section list related to test
            $sections = $this->testPackagesRepository->getSectionList($test['TestPackageTestID']);
            if ($test_package->IsAutoTestCreation == 1) { // Test in Auto Mode
                $sections_view = view('partials.section_auto', compact('sections'))->render();
            } else { // Test in Manual Mode
                $sections_view = view('partials.section', compact('sections'))->render();
            }

            $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 0);
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
            return view('admin.test_package.test_edit', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types', 'test', 'assigned_view', 'sections_view', 'remain_marks', 'remain_que_view'));
        }

        // Get Assigned subject topic list related to test
        $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($test['TestPackageTestID']);
        $assigned_view = view('partials.assigned_subject_topic', compact('assigned_st'))->render();

        // Get section list related to test
        $sections = $this->testPackagesRepository->getSectionList($test['TestPackageTestID']);
        if ($test_package->IsAutoTestCreation == 1) { // Test in Auto Mode
            $sections_view = view('partials.section_auto', compact('sections'))->render();
        } else { // Test in Manual Mode
            $sections_view = view('partials.section', compact('sections'))->render();
        }

        $subjects = $this->subjectRepository->getSubjectListByCourseID($test_package->CourseID);
        return view('admin.test_package.competitive_test_edit', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types', 'test', 'assigned_view', 'sections_view', 'remain_marks', 'remain_que_view'));
    }

    /**
     * Update Test detail
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function testUpdate(Request $request, $id)
    {
        $data = $request->all();
        $test = $this->testPackagesRepository->testUpdate($data, $id);
        return redirect()->route('test_edit', [$test['TestPackageID'], $test['TestPackageTestID']])
                ->with('success', Lang::get('admin.ca_update_successfully'));
    }

    /**
     * Get test detail with section info for ajax view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function test_ajaxView(Request $request)
    {
        $data = $request->all();

        // Get test detail
        $test = $this->testPackagesRepository->getTestDetail($data['TestPackageTestID']);
        $test_name = $test->TestName;
        
        // Get section info related to test
        $sections = $this->testPackagesRepository->getSectionList($test['TestPackageTestID']);

        if ($test->testPackage->IsAutoTestCreation == 1) { // Test in Auto Mode
            if ($test->testPackage->IsCompetetive == 0) { // Academic
                $assigned = $this->testPackagesRepository->getAssignedChapterTopic($test['TestPackageTestID']);
            } else { // Competetive
                $assigned = $this->testPackagesRepository->getAssignedSubjectTopic($test['TestPackageTestID']);
            }

            $list = view('partials.question_view', compact('test', 'assigned', 'sections'))->render();
        } else { // Test in Manual Mode
            $sec = [];
            foreach ($sections as $section) {
                $sec['SectionName'] = $section['SectionName'];
                $sec['secQueType'] = [];
                if (isset($section->questionTypes)) {
                    $secQueType = [];
                    foreach ($section->questionTypes as $questionType) {
                        $secQueType['QuestionTypeID'] = $questionType['QuestionTypeID'];
                        $secQueType['questionTypeName'] = $questionType['questionType']['QuestionTypeName'];
                        $secQueType['NumberofQuestion'] = $questionType['NumberofQuestion'];
                        $secQueType['QuestionMarks'] = $questionType['QuestionMarks'];

                        $Que = [];
                        foreach($questionType->testQuestion as $question) {
                            $Que['QuestionID'] = $question['QuestionID'];
                            $Que['QuestionTypeID'] = $question['question']['QuestionTypeID'];
                            $Que['QuestionText'] = $question['question']['QuestionText'];
                            if ($question['question']['QuestionTypeID'] != 2 && $question['question']['QuestionTypeID'] != 4 ) {
                                $Que['Options'] = $this->questionRepository->getQuestionOptionAnswer($question['QuestionID'], $question['question']['QuestionTypeID']);
                            }
                            $secQueType['Que'][] = $Que;
                        }
                        $sec['secQueType'][] = $secQueType;
                    }
                }
                $test_sections[] = $sec;
            }
            $list = view('partials.question_paper', compact('test_sections'))->render();
        }

        return response()->json([
            'success' => true,
            'list' => $list,
            'test_name' => $test_name,
        ]);
    }

    /**
     * Delete test by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function test_ajaxdelete(Request $request)
    {
        $data = $request->all();

        $this->testPackagesRepository->deleteTest($data['TestPackageTestID']);
        $tests = $this->testPackagesRepository->getTests($data['TestPackageID']);
        $list = view('partials.test', compact('tests'))->render();
        return response()->json([
            'success' => true,
            'list' => $list,
        ]);
    }

    /**
     * To publish test
     *
     * @param  int $id
     * @param  int $test_id
     * @return \Illuminate\Http\Response
     */
    public function testPublish($id, $test_id)
    {
        // Get count of total marks and questions
        $count_data = $this->testPackagesRepository->countMarkQuestion($test_id);
        $total_marks = array_sum(array_column($count_data, 'TotalSecMarks'));
        $total_ques = array_sum(array_column($count_data, 'TotalSecQues'));
        
        // Get test detail
        $test_detail = $this->testPackagesRepository->getTest($test_id);
        $remain_marks = $test_detail['TestMarks'] - $total_marks;
        if ($remain_marks > 0) {
            return redirect()->back()->with('error', Lang::get('Marks Entered do not Equate with Total Marks. Please Check Again'));
        }

        // Get test package detail
        $test_package = $this->testPackagesRepository->getPackageDetail($id);
        if ($test_package->IsAutoTestCreation == 0) { // Test in Manual Mode

            // Get Section list related to test
            $sections = $this->testPackagesRepository->getSectionList($test_id);
            foreach ($sections as $section) {
                if (isset($section->questionTypes)) {
                    foreach($section->questionTypes as $questionType) {
                        if($questionType->testQuestion->count() < $questionType->NumberofQuestion) {
                            return redirect()->back()->with('error', Lang::get('Questions do not Equate with Total Questions. Please Check Again'));
                        }
                    }
                }
            }
        }

        // Do publish test
        $response = $this->testPackagesRepository->testPublish($test_id);
        if ($response) {
            return redirect()->route('testPackages.edit', [$id, 'tab' => 'test'])->with('success', Lang::get('admin.ca_test_publish_successfully'));
        } else {
            return redirect()->back()->with('error', Lang::get('admin.ca_test_publish_failed'));
        }
    }

    /**
     * Store chapter/topic weightage by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignChapterTopic(Request $request)
    {
        $data = $request->all();

        // Count remain weightage if it's less then 100 then create else show message
        $remain_weightage = $this->testPackagesRepository->countWeightage($data['TestPackageID'], $data['TestPackageTestID']);
        if ($remain_weightage > 0 && $data['Weightage'] <= $remain_weightage) {
            // Assign chapter topic
            $this->testPackagesRepository->assignChapterTopic($data);

            // Get assigned chapter topic list
            $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
            $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();

            // Get count of remain questions groupby queation type
            $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
            $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
            $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
            $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

            return response()->json([
                'success' => true,
                'list' => $list,
                'remain_que_view' => $remain_que_view,
                'remain_weightage' => $remain_weightage,
                'question_types' => $question_types,
            ]);
        }

        // Get assigned chapter topic list
        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();

        return response()->json([
            'error' => true,
            'message' => 'Total weightage of assigned chapters must be 100',
            'list' => $list
        ]);
    }

    /**
     * Store subject/topic weightage by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignSubjectTopic(Request $request)
    {
        $data = $request->all();

        // Count remain weightage if it's less then 100 then create else show message
        $remain_weightage = $this->testPackagesRepository->countWeightage($data['TestPackageID'], $data['TestPackageTestID']);
        if ($remain_weightage > 0 && $data['Weightage'] <= $remain_weightage) {
            // Assign subject topic
            $this->testPackagesRepository->assignSubjectTopic($data);
            $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($data['TestPackageTestID']);
            $list = view('partials.assigned_subject_topic', compact('assigned_st'))->render();

            // Get count of remain questions groupby queation type
            $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
            $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
            $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
            $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

            return response()->json([
                'success' => true,
                'list' => $list,
                'remain_que_view' => $remain_que_view,
                'question_types' => $question_types,
            ]);
        }

        // Get assigned subject topic list
        $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_subject_topic', compact('assigned_st'))->render();

        return response()->json([
            'error' => true,
            'message' => 'Total weightage of assigned subjects must be 100',
            'list' => $list
        ]);
    }

    /**
     * Delete assigned chapters and topics by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAssignChapterTopic(Request $request)
    {
        $data = $request->all();

        // Delete assigned chapter topic
        $this->testPackagesRepository->deleteAssignedChapterTopic($data['TestChapterTopicID']);
        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();

        // Get count of remain questions groupby queation type
        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        return response()->json([
            'success' => true,
            'list' => $list,
            'remain_que_view' => $remain_que_view,
            'question_types' => $question_types,
        ]);
    }

    /**
     * Delete assigned subjects and topics by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAssignSubjectTopic(Request $request)
    {
        $data = $request->all();
        
        // Delete assigned subject topic
        $this->testPackagesRepository->deleteAssignedSubjectTopic($data['TestSubjectTopicID']);
        $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_subject_topic', compact('assigned_st'))->render();

        // Get count of remain questions groupby queation type
        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        return response()->json([
            'success' => true,
            'list' => $list,
            'remain_que_view' => $remain_que_view,
            'question_types' => $question_types,
        ]);
    }

    /**
     * Store section by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addSection(Request $request)
    {
        $data = $request->all();

        // Count remain weightage if it's less then 100 then create else show message
        $remain_weightage = $this->testPackagesRepository->countWeightage($data['TestPackageID'], $data['TestPackageTestID']);
        if ($remain_weightage < 100 && $remain_weightage != 0) {
            return response()->json([
                'error' => true,
                'view' => 'weightage',
                'message' => 'Total weightage of assigned subjects must be 100',
            ]);
        }

        // Get count of remain questions groupby queation type
        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $remain_question_count = $remain_que->pluck('total', 'QuestionTypeID');
        if ($remain_question_count[$data['QuestionTypeID']] < $data['NumberofQuestion']) {
            return response()->json([
                'error' => true,
                'message' => 'Number of Question is not available. Please Check Again',
            ]);
        }

        // Get count of total marks and questions
        $count_data = $this->testPackagesRepository->countMarkQuestion($data['TestPackageTestID']);
        $total_marks = array_sum(array_column($count_data, 'TotalSecMarks'));
        $total_ques = array_sum(array_column($count_data, 'TotalSecQues'));
        $new_total_marks = $data['NumberofQuestion'] * $data['QuestionMarks'];

        // Get test detail
        $test_detail = $this->testPackagesRepository->getTest($data['TestPackageTestID']);
        $remain_marks = $test_detail['TestMarks'] - $total_marks;

        // Check Entered Marks Equate with Total Marks or not
        if ($total_marks < $test_detail['TestMarks'] && $new_total_marks + $total_marks <= $test_detail['TestMarks']) {
            $this->testPackagesRepository->addSection($data);
            $remain_marks = $remain_marks - $new_total_marks;
            // Get count of total marks and questions
            $count_data = $this->testPackagesRepository->countMarkQuestion($data['TestPackageTestID']);
            $test_data['NumberofQuestion'] = array_sum(array_column($count_data, 'TotalSecQues'));
            $test = $this->testPackagesRepository->testUpdate($test_data, $data['TestPackageTestID']);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Marks Entered do not Equate with Total Marks. Please Check Again',
            ]);
        }
        
        // Get count of remain questions groupby queation type
        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        // Get Section list related to test
        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);

        // Get Test package details
        $test_package = $this->testPackagesRepository->edit($test_detail->TestPackageID);
        if ($test_package->IsAutoTestCreation == 1) { // Test lin Auto mode
            $list = view('partials.section_auto', compact('sections'))->render();
        } else { // Test in Manual
            $list = view('partials.section', compact('sections'))->render();
        }

        return response()->json([
            'success' => true,
            'list' => $list,
            'remain_marks' => $remain_marks,
            'remain_que_view' => $remain_que_view,
            'question_types' => $question_types,
        ]);
    }

    /**
     * Delete section by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSection(Request $request)
    {
        $data = $request->all();

        // Delete section
        $this->testPackagesRepository->deleteSection($data['TestSectionQuestionTypeID']);

        // Get count of total marks and questions
        $count_data = $this->testPackagesRepository->countMarkQuestion($data['TestPackageTestID']);
        $total_marks = array_sum(array_column($count_data, 'TotalSecMarks'));
        $test_data['NumberofQuestion'] = array_sum(array_column($count_data, 'TotalSecQues'));

        // Update test
        $test = $this->testPackagesRepository->testUpdate($test_data, $data['TestPackageTestID']);

        // Get count of remain questions groupby queation type
        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $remain_question_count = $remain_que->pluck('total', 'QuestionTypeID');
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        // Get test detail
        $test_detail = $this->testPackagesRepository->getTest($data['TestPackageTestID']);
        $remain_marks = $test_detail['TestMarks'] - $total_marks;

        // Get Section list related to test
        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);

        // Get Test Package Detail
        $test_package = $this->testPackagesRepository->edit($test_detail->TestPackageID);
        if ($test_package->IsAutoTestCreation == 1) { // Test in Auto mode
            $list = view('partials.section_auto', compact('sections'))->render();
        } else { // Test in Manual Mode
            $list = view('partials.section', compact('sections'))->render();
        }

        return response()->json([
            'success' => true,
            'list' => $list,
            'remain_marks' => $remain_marks,
            'remain_que_view' => $remain_que_view,
            'question_types' => $question_types,
        ]);
    }
}