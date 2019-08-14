<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\BoardRepository;
use App\Http\Requests\BoardStoreRequest;
use App\Http\Requests\BoardUpdateRequest;
use Config;
use Lang;

class BoardsController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var BoardRepository
     */
    protected $boardRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BaseRepository $baseRepository, BoardRepository $boardRepository)
    {
        $this->baseRepository = $baseRepository;
        $this->boardRepository = $boardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = $this->boardRepository->list();
        return view('admin.board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BoardStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardStoreRequest $request)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='board');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.BOARD_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->boardRepository->store($data);
        if ($response) {
            return redirect()->route('boards.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('boards.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $board = $this->boardRepository->edit($id);
        return view('admin.board.edit', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BoardUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoardUpdateRequest $request, $id)
    {
        $data = $request->all();

        $image_info = $this->baseRepository->imageUpload($request, $type='board');
        if (!empty($image_info)) {
            $data['Icon'] = Config::get('settings.BOARD_IMG_PATH') . '/' .$image_info['image_name'];
        }

        $response = $this->boardRepository->update($data, $id);
        if ($response) {
            return redirect()->route('boards.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('boards.index')->with('error', Lang::get('admin.ca_update_failed'));
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
