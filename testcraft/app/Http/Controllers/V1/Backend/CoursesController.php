<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\CourseRepository;
use App\Repositories\CourseTypeRepository;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use Config;
use Lang;

class CoursesController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * @var CourseTypeRepository
     */
    protected $courseTypeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseRepository $baseRepository,
        CourseRepository $courseRepository,
        CourseTypeRepository $courseTypeRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->courseRepository = $courseRepository;
        $this->courseTypeRepository = $courseTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepository->list();
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course_types = $this->courseTypeRepository->getCourseTypeDropdown();
        return view('admin.course.create', compact('course_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CourseStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='course');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.COURSE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->courseRepository->store($data);
        if ($response) {
            return redirect()->route('courses.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('courses.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $course = $this->courseRepository->edit($id);
        $course_types = $this->courseTypeRepository->getCourseTypeDropdown();
        return view('admin.course.edit', compact('course','course_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CourseUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='course');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.COURSE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->courseRepository->update($data, $id);
        if ($response) {
            return redirect()->route('courses.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('courses.index')->with('error', Lang::get('admin.ca_update_failed'));
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
