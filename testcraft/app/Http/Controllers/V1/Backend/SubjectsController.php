<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\SubjectRepository;
use App\Http\Requests\SubjectStoreRequest;
use App\Http\Requests\SubjectUpdateRequest;
use Config;
use Lang;

class SubjectsController extends Controller
{

    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BaseRepository $baseRepository, SubjectRepository $subjectRepository)
    {
        $this->baseRepository = $baseRepository;
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = $this->subjectRepository->list();
        return view('admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStoreRequest $request)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='subject');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.SUBJECT_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->subjectRepository->store($data);
        if ($response) {
            return redirect()->route('subjects.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('subjects.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $subject = $this->subjectRepository->edit($id);
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SubjectUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='subject');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.SUBJECT_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->subjectRepository->update($data, $id);
        if ($response) {
            return redirect()->route('subjects.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('subjects.index')->with('error', Lang::get('admin.ca_update_failed'));
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
     * Get subject list by ajax call based on board, standard
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSubjectListByAjax(Request $request)
    {
        $data = [];
        $board_standard_validator = Validator::make($request->all(), [
            'board_id' => 'required',
            'standard_id' => 'required',
        ]);
        
        $course_validator = Validator::make($request->all(), [
            'course_id' => 'required',
        ]);

        if ($board_standard_validator->passes()) {
            $data = $this->subjectRepository->getSubjectListByBoardStandardID($request->board_id, $request->standard_id);
        } else if ($course_validator->passes()) {
            $data = $this->subjectRepository->getSubjectListByCourseID($request->course_id);
            // if (count($subjects) > 0) {
            //     foreach ($subjects as $key => $subject) {
            //         $data[$subject->CourseSubjectID] = $subject->SubjectName;
            //     }
            // }
        } else {
            return response()->json([
                'error'   => true,
                'message' => $course_validator->errors()
            ]);
        }


        return response()->json([
            'success' => true,
            'data'  => $data,
        ]);
    }
}
