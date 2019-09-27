<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TestTypeRepository;
use Config;
use Lang;

class TestTypesController extends Controller
{
    /**
     * @var TestTypeRepository
     */
    protected $testTypeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TestTypeRepository $testTypeRepository)
    {
        $this->testTypeRepository = $testTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test_types = $this->testTypeRepository->list();
        return view('admin.test_type.index', compact('test_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function testTypeData_ajaxget(Request $request)
    {
        $package_id = $request->id;
        $test_type_id = $request->test_type_id;
        switch ($test_type_id) {
            case '1':
                $test_types = $this->testTypeRepository->getChapterDropdown($package_id);
                break;

            case '2':
                $test_types = $this->testTypeRepository->getTopicDropdown($package_id);
                break;

            case '3':
                $test_types = $this->testTypeRepository->getUnitDropdown();
                break;

            default:
                $test_types = "";
                break;

        }

        return response()->json([
            'success' => true,
            'data'  => $test_types,
        ]);
    }
}
