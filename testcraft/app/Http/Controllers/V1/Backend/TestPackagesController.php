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
        QuestionTypeRepository $questionTypeRepository,
        TestPackagesRepository $testPackagesRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->boardRepository = $boardRepository;
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->standardRepository = $standardRepository;
        $this->testTypeRepository = $testTypeRepository;
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
        if ($test_package->IsCompetetive == 1) {
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
        if ($test_package->IsCompetetive == 1) {
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
        $courses = $this->courseRepository->getCourseDropdown();
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
        $standards = [];
        $subjects = [];

        $test_package = $this->testPackagesRepository->edit($id);
        if ($test_package->IsCompetetive == 1) {
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
        return view('admin.test_package.edit', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests'));
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
        if ($test_package->IsCompetetive == 1) {
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
        }

        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        $tests = $this->testPackagesRepository->getTests($id);
        $question_types = $this->questionTypeRepository->getQuestionTypeDropdown();
        //$package_details = $this->testPackagesRepository->getPackageDetail($id);
        // die;
        return view('admin.test_package.test_create', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types'));
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
        if ($test_package->IsCompetetive == 1) {
            $standards = $this->standardRepository->getStandardListByBoardID($test_package->BoardID);
            $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($test_package->BoardID, $test_package->StandardID);
        }

        $boards = $this->boardRepository->getBoardDropdown();
        $courses = $this->courseRepository->getCourseDropdown();
        $test_types = $this->testTypeRepository->getTestTypeDropdown();
        $dif_levels = $this->baseRepository->getDifficultyLevelDropdown();
        $tests = $this->testPackagesRepository->getTests($id);
        $test = $this->testPackagesRepository->getTest($test_id);
        $question_types = $this->questionTypeRepository->getQuestionTypeDropdown();
        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($test['TestPackageTestID']);
        $assigned_view = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();
        $sections = $this->testPackagesRepository->getSectionList($test['TestPackageTestID']);
        $sections_view = view('partials.section', compact('sections'))->render();
        //$package_details = $this->testPackagesRepository->getPackageDetail($id);
        /*echo "<pre>";
        print_r($sections->toArray());
        die;*/
        return view('admin.test_package.test_edit', compact('test_package', 'boards', 'courses', 'subjects', 'standards', 'dif_levels', 'test_types', 'tests', 'question_types', 'test', 'assigned_view', 'sections_view'));
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
     * Store chapter/topic weightage by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignChapterTopic(Request $request)
    {
        $data = $request->all();

        $this->testPackagesRepository->assignChapterTopic($data);
        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();
        return response()->json([
            'list' => $list,
        ]);
    }

    /**
     * List of assigned chapters and topics by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAssignChapterTopicList(Request $request)
    {
        $data = $request->all();
     
        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();
        return response()->json([
            'list' => $list,
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
     
        $this->testPackagesRepository->deleteAssignedChapterTopic($data['TestChapterTopicID']);
        $assigned_ct = $this->testPackagesRepository->getAssignedChapterTopic($data['TestPackageTestID']);
        $list = view('partials.assigned_chapter_topic', compact('assigned_ct'))->render();
        return response()->json([
            'list' => $list,
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

        $this->testPackagesRepository->addSection($data);
        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);
        $list = view('partials.section', compact('sections'))->render();
        return response()->json([
            'list' => $list,
        ]);
    }

    /**
     * List of sections by ajax and return view
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSectionList(Request $request)
    {
        $data = $request->all();
     
        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);
        $list = view('partials.section', compact('sections'))->render();
        return response()->json([
            'list' => $list,
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
     
        $this->testPackagesRepository->deleteSection($data['TestSectionQuestionTypeID']);
        $sections = $this->testPackagesRepository->getSectionList($data['TestPackageTestID']);
        $list = view('partials.section', compact('sections'))->render();
        return response()->json([
            'list' => $list,
        ]);
    }
}
