<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UnitRepository;
use App\Repositories\BoardRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\StandardRepository;
use App\Repositories\ChapterRepository;
use App\Http\Requests\UnitStoreRequest;
use App\Http\Requests\UnitUpdateRequest;
use Config;
use Lang;

class UnitsController extends Controller
{
    /**
     * @var BoardRepository
     */
    protected $boardRepository;

    /**
     * @var UnitRepository
     */
    protected $unitRepository;

    /**
     * @var StandardRepository
     */
    protected $standardRepository;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    /**
     * @var ChapterRepository
     */
    protected $chapterRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UnitRepository $unitRepository,
        BoardRepository $boardRepository,
        SubjectRepository $subjectRepository,
        StandardRepository $standardRepository,
        ChapterRepository $chapterRepository
    ){
        $this->unitRepository = $unitRepository;
        $this->boardRepository = $boardRepository;
        $this->subjectRepository = $subjectRepository;
        $this->standardRepository = $standardRepository;
        $this->chapterRepository = $chapterRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = $this->unitRepository->list();
        return view('admin.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boards = $this->boardRepository->getBSSCTBasedBoardDropdown();
        return view('admin.unit.create', compact('boards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UnitStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitStoreRequest $request)
    {
        $data = $request->all();

        $response = $this->unitRepository->store($data);
        if ($response) {
            return redirect()->route('units.index')
                ->with('success', Lang::get('admin.ca_create_successfully'));
        }

        return redirect()->route('units.index')->with('error', Lang::get('admin.ca_create_failed'));
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
        $unit = $this->unitRepository->edit($id);
        $boards = $this->boardRepository->getBSSCTBasedBoardDropdown();
        $standards = $this->standardRepository->getStandardListByBoardID($unit->BoardID);
        $subjects = $this->subjectRepository->getSubjectListByBoardStandardID($unit->BoardID, $unit->StandardID);
        $chapters = $this->chapterRepository->getChapterDropdown($unit->BoardID, $unit->StandardID, $unit->SubjectID);
        return view('admin.unit.edit', compact('unit', 'boards', 'standards', 'subjects', 'chapters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UnitUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitUpdateRequest $request, $id)
    {
        $data = $request->all();
        $response = $this->unitRepository->update($data, $id);
        if ($response) {
            return redirect()->route('units.index')
                ->with('success', Lang::get('admin.ca_update_successfully'));
        }

        return redirect()->route('units.index')->with('error', Lang::get('admin.ca_update_failed'));
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
     * Get unit name list by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getUnitListByAjax(Request $request)
    {
        $data = [];

        $units = $this->unitRepository->getUnitList();

        return response()->json([
            'success' => true,
            'data'  => $units,
        ]);
    }
}
