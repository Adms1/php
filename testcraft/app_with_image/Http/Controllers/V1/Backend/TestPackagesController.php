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
     * Show demo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function demo()
    {
        $id = 50;
        $standards = [];
        $subjects = [];

        $test_package = $this->testPackagesRepository->edit($id);
        if ($test_package->IsCompetetive == 0) {
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
        }

        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        $tests = $this->testPackagesRepository->getTests($id);
        //$package_details = $this->testPackagesRepository->getPackageDetail($id);
        // die;
        return view('admin.test_package.demo', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests'));
    }

    /**
     * Show demo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function demo2()
    {
        $id = 50;
        $standards = [];
        $subjects = [];

        $test_package = $this->testPackagesRepository->edit($id);
        if ($test_package->IsCompetetive == 0) {
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
        }

        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        $tests = $this->testPackagesRepository->getTests($id);
        //$package_details = $this->testPackagesRepository->getPackageDetail($id);
        // die;
        return view('admin.test_package.demo2', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests'));
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
        /*echo "<pre>";
        print_r($test_package->toArray());
        die;*/
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
        $standards = [];
        $subjects = [];

        $test_package = $this->testPackagesRepository->edit($id);
        if ($test_package->IsCompetetive == 0) {
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
        }

        $boards = $this->boardRepository->getBSSCTBasedBoardDropdown();
        $courses = $this->courseRepository->getCSTBasedCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        $tests = $this->testPackagesRepository->getTests($id);
        $remain = $this->testPackagesRepository->getCountOfRemainNumberOfTest($id);
        //$package_details = $this->testPackagesRepository->getPackageDetail($id);
        // die;
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

        $response = $this->testPackagesRepository->update($data, $id);
        if ($response) {
            return redirect()->route('testPackages.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('testPackages.index')->with('error', Lang::get('admin.ca_update_failed'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /*public function storeTestPackageTest(Request $request)
    {
        $data = $request->all();

        $remain = $this->testPackagesRepository->getCountOfRemainNumberOfTest($data['PackageID']);
        if ($remain == 0) {
            $validator = Validator::make($request->all(), [
                'NumberofQuestion' => 'required|lt:'.$remain,
            ], [
                'lt' => 'You can not create test greater than total number of tests in package',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'NumberofQuestion' => 'required|lte:'.$remain,
            ], [
                'lte' => 'Number of test must be less than or equal to '.$remain,
            ]);
        }

        if (!$validator->passes()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $response = $this->testPackagesRepository->storeTestPackageTest($data);
        if ($response) {
            return redirect()->route('testPackages.edit', [$data['PackageID'], 'tab' => 'detail'])
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('testPackages.edit', [$data['PackageID'], 'tab' => 'detail'])->with('error', Lang::get('admin.ca_create_failed'));
    }*/

    /**
     * Delete packageDetail by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /*public function packageDetail_ajaxdelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_detail_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $package_detail = $this->testPackagesRepository->deletePackageDetail($request->all());
            return response()->json([
                'success' => true,
                'data'  => $package_detail,
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }*/

    /**
     * Create test view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function testCreate($id)
    {
        $standards = [];
        $subjects = [];

        $test_package = $this->testPackagesRepository->edit($id);
        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $tests = $this->testPackagesRepository->getTests($id);
        $question_types = $this->questionTypeRepository->getQuestionTypeDropdown();
        $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 1);

        if ($test_package->IsCompetetive == 0) {
            $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 0);
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
            return view('admin.test_package.test_create', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types'));
        }
        //$package_details = $this->testPackagesRepository->getPackageDetail($id);
        // die;
        
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

        // $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        // $view = view('partials.test_edit', compact('test', 'dif_levels'))->render();
        // return response()->json([
        //     'view' => $view,
        //     'test_id' => $test['TestPackageTestID'],
        // ]);

        // For ajax
        // $tests = $this->testPackagesRepository->getTests($data['TestPackageID']);
        // $list = view('partials.test', compact('tests'))->render();
        // return response()->json([
        //     'list' => $list,
        // ]);
    }

    /**
     * Create test view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function testEdit($id, $test_id)
    {
        $standards = [];
        $subjects = [];

        $test_package = $this->testPackagesRepository->edit($id);
        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 1);
        $tests = $this->testPackagesRepository->getTests($id);
        $test = $this->testPackagesRepository->getTest($test_id);

        // Get count of total marks and questions
        $count_data = $this->testPackagesRepository->countMarkQuestion($test_id);
        $total_marks = array_sum(array_column($count_data, 'TotalSecMarks'));
        $remain_marks = $test['TestMarks'] - $total_marks;
        //$question_types = $this->questionTypeRepository->getQuestionTypeDropdown();

        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($test_id);
        /*die;
        echo "<pre>";
        print_r($remain_que->toArray());
        die;*/
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();
        /*echo "<pre>";
        print_r($sections->toArray());
        die;*/

        if ($test_package->IsCompetetive == 0) {
            $dif_levels = $this->baseRepository->getDifficultyByAjax($is_competetive = 0);
            $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($test['TestPackageTestID']);
            $assigned_view = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();
            $sections = $this->testPackagesRepository->getSectionList($test['TestPackageTestID']);

            if ($test_package->IsAutoTestCreation == 1) {
                $sections_view = view('partials.section_auto', compact('sections'))->render();
            } else {
                $sections_view = view('partials.section', compact('sections'))->render();
            }

            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
            return view('admin.test_package.test_edit', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types', 'test', 'assigned_view', 'sections_view', 'remain_marks', 'remain_que_view'));
        }

        $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($test['TestPackageTestID']);
        $assigned_view = view('partials.assigned_subject_topic', compact('assigned_st'))->render();
        $sections = $this->testPackagesRepository->getSectionList($test['TestPackageTestID']);

        if ($test_package->IsAutoTestCreation == 1) {
            $sections_view = view('partials.section_auto', compact('sections'))->render();
        } else {
            $sections_view = view('partials.section', compact('sections'))->render();
        }

        //$package_details = $this->testPackagesRepository->getPackageDetail($id);
        $subjects = $this->subjectRepository->getSubjectListByCourseID($test_package->CourseID);
        return view('admin.test_package.competitive_test_edit', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types', 'test', 'assigned_view', 'sections_view', 'remain_marks', 'remain_que_view'));
    }

    /**
     * Store Test by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function testUpdate(Request $request, $id)
    {
        $data = $request->all();
        $test = $this->testPackagesRepository->testUpdate($data, $id);
        return redirect()->route('test_edit', [$test['TestPackageID'], $test['TestPackageTestID']])
                ->with('success', Lang::get('admin.ca_update_successfully'));

        // $view = view('partials.test_edit', compact('test'))->render();
        // return response()->json([
        //     'view' => $view,
        // ]);

        // For ajax
        // $tests = $this->testPackagesRepository->getTests($data['TestPackageID']);
        // $list = view('partials.test', compact('tests'))->render();
        // return response()->json([
        //     'list' => $list,
        // ]);
    }

    /**
     * Store Test by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function test_ajaxView(Request $request)
    {
        $data = $request->all();
        $test = $this->testPackagesRepository->getTestDetail($data['TestPackageTestID']);
        $test_name = $test->TestName;
        $sections = $this->testPackagesRepository->getSectionList($test['TestPackageTestID']);
        //echo "<pre>";
        /*print_r($sections->toArray());
        die;*/
        if ($test->testPackage->IsAutoTestCreation == 1) {
            if ($test->testPackage->IsCompetetive == 0) {
                $assigned = $this->testPackagesRepository->getAssignedChapterTopic($test['TestPackageTestID']);
            } else {
                $assigned = $this->testPackagesRepository->getAssignedSubjectTopic($test['TestPackageTestID']);
            }

            $list = view('partials.question_view', compact('test', 'assigned', 'sections'))->render();
        } else {
            $sec = [];
            foreach ($sections as $section) {
                /*print_r($section->toArray());
                echo "--------------------";*/
                $sec['SectionName'] = $section['SectionName'];
                $sec['secQueType'] = [];
                if (isset($section->questionTypes)) {
                    $secQueType = [];
                    foreach ($section->questionTypes as $questionType) {
                        $secQueType['QuestionTypeID'] = $questionType['QuestionTypeID'];
                        $secQueType['questionTypeName'] = $questionType['questionType']['QuestionTypeName'];
                        $secQueType['NumberofQuestion'] = $questionType['NumberofQuestion'];
                        $secQueType['QuestionMarks'] = $questionType['QuestionMarks'];
                        //$secQueType['Que'] = [];
                        //$sec['secQueType'][] = $secQueType;
                        /*print_r($questionType->toArray());
                        echo "+++++++++++++++++++++";*/
                        //$sec['secQueType']['Que'] = [];
                        $Que = [];
                        foreach($questionType->testQuestion as $question) {
                            $Que['QuestionID'] = $question['QuestionID'];
                            $Que['QuestionTypeID'] = $question['question']['QuestionTypeID'];
                            $Que['QuestionText'] = $question['question']['QuestionText'];
                            $Que['QuestionImage'] = $question['question']['QuestionImage'];
                            if ($question['question']['QuestionTypeID'] != 2 && $question['question']['QuestionTypeID'] != 4 ) {
                                $Que['Options'] = $this->questionRepository->getQuestionOptionAnswer($question['QuestionID'], $question['question']['QuestionTypeID']);
                            }
                            $secQueType['Que'][] = $Que;

                            //print_r($question->toArray());
                            /*print_r($Que);
                            echo "*****************";
                            die;*/
                        }
                        $sec['secQueType'][] = $secQueType;
                    }
                }
                /*print_r($sec);
                die;*/
                $test_sections[] = $sec;
            }
            /*echo "<pre>";
            print_r($test_sections);
            die;*/
            $list = view('partials.question_paper', compact('test_sections'))->render();
        }

        //$list = view('partials.test', compact('test'))->render();
        return response()->json([
            'success' => true,
            'list' => $list,
            'test_name' => $test_name,
        ]);

        // $view = view('partials.test_edit', compact('test'))->render();
        // return response()->json([
        //     'view' => $view,
        // ]);

        // For ajax
        // $tests = $this->testPackagesRepository->getTests($data['TestPackageID']);
        // $list = view('partials.test', compact('tests'))->render();
        // return response()->json([
        //     'list' => $list,
        // ]);
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
     * Store chapter/topic weightage by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignChapterTopic(Request $request)
    {
        $data = $request->all();

        $remain_weightage = $this->testPackagesRepository->countWeightage($data['TestPackageID'], $data['TestPackageTestID']);
        if ($remain_weightage > 0 && $data['Weightage'] <= $remain_weightage) {
            $this->testPackagesRepository->assignChapterTopic($data);
            $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
            $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();

            $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
            $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
            $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
            $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

            return response()->json([
                'success' => true,
                'list' => $list,
                'remain_que_view' => $remain_que_view,
                'remain_weightage' => $remain_weightage,
                'question_types' => $question_types,
            ]);
        }

        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();

        return response()->json([
            'error' => true,
            'message' => 'Total weightage of assigned chapters must be 100',
            'list' => $list
        ]);
    }

    /**
     * Store chapter/topic weightage by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignSubjectTopic(Request $request)
    {
        $data = $request->all();

        $remain_weightage = $this->testPackagesRepository->countWeightage($data['TestPackageID'], $data['TestPackageTestID']);
        /*print_r($data['Weightage']);
        print_r($remain_weightage);
        die;*/
        if ($remain_weightage > 0 && $data['Weightage'] <= $remain_weightage) {
            $this->testPackagesRepository->assignSubjectTopic($data);
            $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($data['TestPackageTestID']);
            $list = view('partials.assigned_subject_topic', compact('assigned_st'))->render();

            $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
            $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
            $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
            $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

            return response()->json([
                'success' => true,
                'list' => $list,
                'remain_que_view' => $remain_que_view,
                'question_types' => $question_types,
            ]);
        }

        $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_subject_topic', compact('assigned_st'))->render();

        return response()->json([
            'error' => true,
            'message' => 'Total weightage of assigned subjects must be 100',
            'list' => $list
        ]);
    }

    /**
     * List of assigned chapters and topics by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // public function getAssignChapterTopicList(Request $request)
    // {
    //     $data = $request->all();
     
    //     $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
    //     $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();
    //     return response()->json([
    //         'list' => $list,
    //     ]);
    // }

    /**
     * Delete assigned chapters and topics by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAssignChapterTopic(Request $request)
    {
        $data = $request->all();
     
        $this->testPackagesRepository->deleteAssignedChapterTopic($data['TestChapterTopicID']);
        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);

        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();
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
     
        $this->testPackagesRepository->deleteAssignedSubjectTopic($data['TestSubjectTopicID']);
        $assigned_st = $this->testPackagesRepository->getAssignedSubjectTopic($data['TestPackageTestID']);

        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        $list = view('partials.assigned_subject_topic', compact('assigned_st'))->render();
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

        $remain_weightage = $this->testPackagesRepository->countWeightage($data['TestPackageID'], $data['TestPackageTestID']);

        if ($remain_weightage < 100 && $remain_weightage != 0) {
            return response()->json([
                'error' => true,
                'view' => 'weightage',
                'message' => 'Total weightage of assigned subjects must be 100',
            ]);
        }

        //echo "============";
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
        /*print_r($total_ques);
        die;*/
        $new_total_marks = $data['NumberofQuestion'] * $data['QuestionMarks'];
        // Get test detail
        $test_detail = $this->testPackagesRepository->getTest($data['TestPackageTestID']);
        $remain_marks = $test_detail['TestMarks'] - $total_marks;

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
        
        //print_r($test_detail['TestMarks']);
        //die;
        //$data['QuestionMarks'] * $data['NumberofQuestion']
        // if ($remain_mark > 0 && $data['Weightage'] <= $remain_mark) {
        //     //$this->testPackagesRepository->addSection($data);
        // }
        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);
        $test_package = $this->testPackagesRepository->edit($test_detail->TestPackageID);
        if ($test_package->IsAutoTestCreation == 1) {
            $list = view('partials.section_auto', compact('sections'))->render();
        } else {
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
     * List of sections by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // public function getSectionList(Request $request)
    // {
    //     $data = $request->all();
    //     $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);
        
    //     $test_package = $this->testPackagesRepository->edit($test_detail->TestPackageID);
    //     if ($test_package->IsAutoTestCreation == 1) {
    //         $list = view('partials.section_auto', compact('sections'))->render();
    //     } else {
    //         $list = view('partials.section', compact('sections'))->render();
    //     }
    //     return response()->json([
    //         'list' => $list,
    //     ]);
    // }

    /**
     * Delete section by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSection(Request $request)
    {
        $data = $request->all();

        $this->testPackagesRepository->deleteSection($data['TestSectionQuestionTypeID']);

        // Get count of total marks and questions
        $count_data = $this->testPackagesRepository->countMarkQuestion($data['TestPackageTestID']);
        $total_marks = array_sum(array_column($count_data, 'TotalSecMarks'));
        $test_data['NumberofQuestion'] = array_sum(array_column($count_data, 'TotalSecQues'));
        $test = $this->testPackagesRepository->testUpdate($test_data, $data['TestPackageTestID']);

        $remain_que = $this->testPackagesRepository->getCountOfRemainQuestionType($data['TestPackageTestID']);
        $remain_question_count = $remain_que->pluck('total', 'QuestionTypeID');
        $remain_que_count = $remain_que->pluck('total', 'questionType.QuestionTypeName');
        $question_types = $remain_que->pluck('questionType.QuestionTypeName','QuestionTypeID');
        $remain_que_view = view('partials.remain_que_count', compact('remain_que_count'))->render();

        // Get test detail
        $test_detail = $this->testPackagesRepository->getTest($data['TestPackageTestID']);
        $remain_marks = $test_detail['TestMarks'] - $total_marks;

        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);

        $test_package = $this->testPackagesRepository->edit($test_detail->TestPackageID);
        if ($test_package->IsAutoTestCreation == 1) {
            $list = view('partials.section_auto', compact('sections'))->render();
        } else {
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
