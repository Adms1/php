<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\InstituteRepository;
use App\Http\Requests\InstituteStoreRequest;
use App\Http\Requests\InstituteUpdateRequest;
use Config;
use Lang;

class InstitutesController extends Controller
{
    /**
     * @var InstituteRepository
     */
    protected $instituteRepository;

    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InstituteRepository $instituteRepository, BaseRepository $baseRepository)
    {
        $this->instituteRepository = $instituteRepository;
        $this->baseRepository = $baseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutes = $this->instituteRepository->list();
        return view('admin.institute.index', compact('institutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.institute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InstituteStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstituteStoreRequest $request)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='institute');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.INSTITUTE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->instituteRepository->store($data);
        if ($response) {
            return redirect()->route('institutes.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('institutes.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $institute = $this->instituteRepository->edit($id);
        return view('admin.institute.edit', compact('institute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InstituteUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstituteUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='institute');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.INSTITUTE_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->instituteRepository->update($data, $id);
        if ($response) {
            return redirect()->route('institutes.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('institutes.index')->with('error', Lang::get('admin.ca_update_failed'));
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
     * Get institute name list by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getInstituteListByAjax(Request $request)
    {
        $data = [];

        $institutes = $this->instituteRepository->getInstituteList();

        return response()->json([
            'success' => true,
            'data'  => $institutes,
        ]);
    }
}
