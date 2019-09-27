<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\StandardRepository;
use App\Http\Requests\StandardStoreRequest;
use App\Http\Requests\StandardUpdateRequest;
use Config;
use Lang;

class StandardsController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var StandardRepository
     */
    protected $standardRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseRepository $baseRepository,
        StandardRepository $standardRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->standardRepository = $standardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $standards = $this->standardRepository->list();
        return view('admin.standard.index', compact('standards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.standard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StandardStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StandardStoreRequest $request)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='standard');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.STANDARD_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->standardRepository->store($data);
        if ($response) {
            return redirect()->route('standards.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('standards.index')->with('error', Lang::get('admin.ca_create_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $standard = $this->standardRepository->edit($id);
        return view('admin.standard.edit', compact('standard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StandardUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StandardUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='standard');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.STANDARD_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->standardRepository->update($data, $id);
        if ($response) {
            return redirect()->route('standards.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('standards.index')->with('error', Lang::get('admin.ca_update_failed'));
    }

    /**
     * Get standard list by ajax call based on board id
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getStandardListByAjax(Request $request)
    {
        $data = [];
        $validator = Validator::make($request->all(), [
            'board_id' => 'required',
        ]);

        if ($validator->passes()) {
            $standards = $this->standardRepository->getStandardListByBoardID($request->board_id);
            return response()->json([
                'success' => true,
                'data'  => $standards,
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }
}
