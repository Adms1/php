<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BoardRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\StandardRepository;
use App\Repositories\BoardStandardSubjectRepository;
use App\Http\Requests\BoardStandardSubjectStoreRequest;
use App\Http\Requests\BoardStandardSubjectUpdateRequest;
use Config;
use Lang;

class BoardStandardSubjectsController extends Controller
{   
    /**
     * @var BoardRepository
     */
    protected $boardRepository;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    /**
     * @var StandardRepository
     */
    protected $standardRepository;

    /**
     * @var BoardStandardSubjectRepository
     */
    protected $boardStandardSubjectRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BoardRepository $boardRepository,
        SubjectRepository $subjectRepository,
        StandardRepository $standardRepository,
        BoardStandardSubjectRepository $boardStandardSubjectRepository
    ){
        $this->boardRepository = $boardRepository;
        $this->subjectRepository = $subjectRepository;
        $this->standardRepository = $standardRepository;
        $this->boardStandardSubjectRepository = $boardStandardSubjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $board_standard_subjects = $this->boardStandardSubjectRepository->list();
        return view('admin.board_standard_subject.index', compact('board_standard_subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boards = $this->boardRepository->getBoardDropdown();
        $subjects = $this->subjectRepository->getSubjectDropdown();
        $standards = $this->standardRepository->getStandardDropdown();
        return view('admin.board_standard_subject.create', compact('boards', 'subjects', 'standards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BoardStandardSubjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardStandardSubjectStoreRequest $request)
    {
        $data = $request->all();

        $response = $this->boardStandardSubjectRepository->store($data);
        if ($response) {
            return redirect()->route('boardStandardSubjects.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('boardStandardSubjects.index')
            ->with('error', Lang::get('admin.ca_create_failed'));
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
        $boards = $this->boardRepository->getBoardDropdown();
        $subjects = $this->subjectRepository->getSubjectDropdown();
        $standards = $this->standardRepository->getStandardDropdown();
        $board_standard_subject = $this->boardStandardSubjectRepository->edit($id);
        return view('admin.board_standard_subject.edit', compact('board_standard_subject', 'boards', 'subjects', 'standards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BoardStandardSubjectUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoardStandardSubjectUpdateRequest $request, $id)
    {
        $data = $request->all();

        $response = $this->boardStandardSubjectRepository->update($data, $id);
        if ($response) {
            return redirect()->route('boardStandardSubjects.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('boardStandardSubjects.index')
            ->with('error', Lang::get('admin.ca_update_failed'));
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
     * Get boardStandardSubjectID by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /*public function getBoardStandardSubjectByAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'board_id' => 'required',
            'standard_id' => 'required',
            'subject_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $id = $this->boardStandardSubjectRepository->getBoardStandardSubjectID($request->board_id, $request->standard_id, $request->subject_id);
            return response()->json([
                'success' => true,
                'data'  => $id,
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }*/
}
