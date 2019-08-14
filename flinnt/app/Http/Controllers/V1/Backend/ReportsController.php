<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;

/*use App\Http\Requests;*/
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ReportCreateRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Repositories\ReportRepository;
use App\Validators\ReportValidator;
use App\Entities\Vendor;
use Auth;

/**
 * Class ReportsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class ReportsController extends Controller
{
    /**
     * @var ReportRepository
     */
    protected $reportRepository;

    /**
     * @var ReportValidator
     */
    protected $validator;

    /**
     * ReportsController constructor.
     *
     * @param ReportRepository $reportRepository
     * @param ReportValidator $validator
     */
    public function __construct(ReportRepository $reportRepository, ReportValidator $validator)
    {
        $this->reportRepository = $reportRepository;
        $this->validator  = $validator;
    }

    /**
     * Display a product listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $vendor_id = isset($data['vendor_id']) ? $data['vendor_id'] : '';

        // Get list of products based on login user
        $products = $this->reportRepository->getBookListByLoginUser($vendor_id);

        // Get vendors dropdown list
        $vendors = Vendor::where('is_active', '1')->pluck('vendor_name', 'vendor_id');

        return view('admin.reports.product_list', compact('products', 'vendors', 'vendor_id'));
    }

    /**
     * Display a order listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderList(Request $request)
    {
        $data = $request->all();
        $vendor_id = isset($data['vendor_id']) ? $data['vendor_id'] : '';

        // Get list of order based on login user
        if (Auth::guard('vendor')->check()) {
            $vendor_id = Auth::guard('vendor')->user()->vendor_id;
            $orders = $this->reportRepository->getOrderListByVendor($vendor_id);
        }

        // Get list of order based on admin or login institution
        if (Auth::guard('admin')->check() || Auth::guard('institution')->check()) {
            $orders = $this->reportRepository->getOrderList($vendor_id);
        }

        // Get vendors dropdown list
        $vendors = Vendor::where('is_active', '1')->pluck('vendor_name', 'vendor_id');

        return view('admin.reports.order_list', compact('orders','vendors', 'vendor_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReportCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(ReportCreateRequest $request)
    // {
    //     try {

    //         $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

    //         $report = $this->reportRepository->create($request->all());

    //         $response = [
    //             'message' => 'Report created.',
    //             'data'    => $report->toArray(),
    //         ];

    //         if ($request->wantsJson()) {

    //             return response()->json($response);
    //         }

    //         return redirect()->back()->with('message', $response['message']);
    //     } catch (ValidatorException $e) {
    //         if ($request->wantsJson()) {
    //             return response()->json([
    //                 'error'   => true,
    //                 'message' => $e->getMessageBag()
    //             ]);
    //         }

    //         return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int $id
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $report = $this->reportRepository->find($id);

    //     if (request()->wantsJson()) {

    //         return response()->json([
    //             'data' => $report,
    //         ]);
    //     }

    //     return view('reports.show', compact('report'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $report = $this->reportRepository->find($id);

    //     return view('reports.edit', compact('report'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReportUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    // public function update(ReportUpdateRequest $request, $id)
    // {
    //     try {

    //         $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

    //         $report = $this->reportRepository->update($request->all(), $id);

    //         $response = [
    //             'message' => 'Report updated.',
    //             'data'    => $report->toArray(),
    //         ];

    //         if ($request->wantsJson()) {

    //             return response()->json($response);
    //         }

    //         return redirect()->back()->with('message', $response['message']);
    //     } catch (ValidatorException $e) {

    //         if ($request->wantsJson()) {

    //             return response()->json([
    //                 'error'   => true,
    //                 'message' => $e->getMessageBag()
    //             ]);
    //         }

    //         return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    //     }
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $deleted = $this->reportRepository->delete($id);

    //     if (request()->wantsJson()) {

    //         return response()->json([
    //             'message' => 'Report deleted.',
    //             'deleted' => $deleted,
    //         ]);
    //     }

    //     return redirect()->back()->with('message', 'Report deleted.');
    // }
}
