<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\CourseTypeRepository;
use App\Http\Requests\CourseTypeStoreRequest;
use App\Http\Requests\CourseTypeUpdateRequest;
use Config;
use Lang;

class CourseTypesController extends Controller
{

    /**
     * @var BaseRepository
     */
    protected $baseRepository;

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
        CourseTypeRepository $courseTypeRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->courseTypeRepository = $courseTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_types = $this->courseTypeRepository->list();
        return view('admin.course_type.index', compact('course_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CourseTypeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseTypeStoreRequest $request)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='course');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.COURSE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->courseTypeRepository->store($data);
        if ($response) {
            return redirect()->route('courseTypes.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('courseTypes.index')->with('error', Lang::get('admin.ca_create_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course_type = $this->courseTypeRepository->edit($id);
        return view('admin.course_type.edit', compact('course_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CourseTypeUpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseTypeUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='course');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.COURSE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->courseTypeRepository->update($data, $id);
        if ($response) {
            return redirect()->route('courseTypes.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('courseTypes.index')->with('error', Lang::get('admin.ca_update_failed'));
    }
}
