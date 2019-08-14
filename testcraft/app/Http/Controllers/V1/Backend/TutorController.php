<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\TutorRepository;
use App\Repositories\InstituteRepository;
use App\Http\Requests\TutorStoreRequest;
use App\Http\Requests\TutorUpdateRequest;
use Config;
use Lang;
use Hash;
use Auth;

class TutorController extends Controller
{

    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var TutorRepository
     */
    protected $tutorRepository;

    /**
     * @var InstituteRepository
     */
    protected $instituteRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseRepository $baseRepository,
        TutorRepository $tutorRepository,
        InstituteRepository $instituteRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->tutorRepository = $tutorRepository;
        $this->instituteRepository = $instituteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutors = $this->tutorRepository->list();
        return view('admin.tutor.index', compact('tutors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $institutes = $this->instituteRepository->getInstituteDropdown();
        return view('tutor.register', compact('institutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tutor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TutorStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TutorStoreRequest $request)
    {
        $data = $request->all();
        $data['TutorPassword'] =  Hash::make($request->TutorPassword);

        $image_info = $this->baseRepository->imageUpload($request, $type='tutor');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.TUTOR_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->tutorRepository->store($data);
        if ($response) {
            return redirect()->route('home')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }
        return redirect()->route('tutors.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $tutor = $this->tutorRepository->edit($id);
        return view('admin.tutor.edit', compact('tutor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TutorUpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TutorUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='tutor');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.TUTOR_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->tutorRepository->update($data, $id);
        if ($response) {
            return redirect()->route('tutors.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('tutors.index')->with('error', Lang::get('admin.ca_update_failed'));
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
