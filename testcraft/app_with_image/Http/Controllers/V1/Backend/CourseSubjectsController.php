<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\CourseSubjectRepository;
use App\Http\Requests\CourseSubjectStoreRequest;
use App\Http\Requests\CourseSubjectUpdateRequest;
use Config;
use Lang;

class CourseSubjectsController extends Controller
{
    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    /**
     * @var CourseSubjectRepository
     */
    protected $courseSubjectRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CourseRepository $courseRepository,
        SubjectRepository $subjectRepository,
        CourseSubjectRepository $courseSubjectRepository
    ){
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->courseSubjectRepository = $courseSubjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_subjects = $this->courseSubjectRepository->list();
        return view('admin.course_subject.index', compact('course_subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = $this->courseRepository->getCourseDropdown();
        $subjects = $this->subjectRepository->getSubjectDropdown();
        return view('admin.course_subject.create', compact('courses', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CourseSubjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseSubjectStoreRequest $request)
    {
        $data = $request->all();

        $response = $this->courseSubjectRepository->store($data);
        if ($response) {
            return redirect()->route('courseSubjects.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('courseSubjects.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $courses = $this->courseRepository->getCourseDropdown();
        $subjects = $this->subjectRepository->getSubjectDropdown();
        $course_subject = $this->courseSubjectRepository->edit($id);
        return view('admin.course_subject.edit', compact('course_subject', 'courses', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CourseSubjectUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseSubjectUpdateRequest $request, $id)
    {
        $data = $request->all();

        $response = $this->courseSubjectRepository->update($data, $id);
        if ($response) {
            return redirect()->route('courseSubjects.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('courseSubjects.index')->with('error', Lang::get('admin.ca_update_failed'));
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
}
