<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\BaseRepository;
use App\Repositories\UserTypeRepository;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Config;
use Lang;
use Hash;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

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
        UserRepository $userRepository,
        BaseRepository $baseRepository,
        UserTypeRepository $userTypeRepository
    ){
        $this->userRepository = $userRepository;
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
        $users = $this->userRepository->list();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('admin.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_types = $this->userTypeRepository->list();
        return view('admin.user.create', compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data['UserPassword'] =  Hash::make($request->UserPassword);

        $image_info = $this->baseRepository->imageUpload($request, $type='user');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.USER_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->userRepository->store($data);
        if ($response) {
            return redirect()->route('users.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('users.index')->with('error', Lang::get('admin.ca_create_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->edit($id);
        $user_types = $this->userTypeRepository->list();
        return view('admin.user.edit', compact('user', 'user_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='user');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.USER_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->userRepository->update($data, $id);
        if ($response) {
            return redirect()->route('users.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('users.index')->with('error', Lang::get('admin.ca_update_failed'));
    }
}
