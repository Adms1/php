<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\UserTypeRepository;
use App\Http\Requests\UserTypeStoreRequest;
use App\Http\Requests\UserTypeUpdateRequest;
use Config;
use Lang;

class UserTypesController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var UserTypeRepository
     */
    protected $userTypeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseRepository $baseRepository,
        UserTypeRepository $userTypeRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->userTypeRepository = $userTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_types = $this->userTypeRepository->list();
        return view('admin.user_type.index', compact('user_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_types = $this->userTypeRepository->list();
        return view('admin.user_type.create', compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserTypeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserTypeStoreRequest $request)
    {
        $data = $request->all();

        $response = $this->userTypeRepository->store($data);
        if ($response) {
            return redirect()->route('userTypes.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('userTypes.index')->with('error', Lang::get('admin.ca_create_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_type = $this->userTypeRepository->edit($id);
        return view('admin.user_type.edit', compact('user_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserTypeUpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserTypeUpdateRequest $request, $id)
    {
        $data = $request->all();

        $response = $this->userTypeRepository->update($data, $id);
        if ($response) {
            return redirect()->route('userTypes.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('userTypes.index')->with('error', Lang::get('admin.ca_update_failed'));
    }
}
