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
     * Get dropdown by ajax call based on test type
     *
     * @return \Illuminate\Http\Response
     */
    public function testTypeData_ajaxget(Request $request)
    {
        $package_id = $request->id;
        $test_type_id = $request->test_type_id;
        switch ($test_type_id) {
            case '1': // Chapter
                $test_types = $this->testTypeRepository->getChapterDropdown($package_id);
                break;

            case '2': // Topic
                $test_types = $this->testTypeRepository->getTopicDropdown($package_id);
                break;

            case '3': // Unit
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
