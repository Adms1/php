<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*use App\Http\Requests;*/
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CourierCreateRequest;
use App\Http\Requests\CourierUpdateRequest;
use App\Repositories\CourierRepository;
use App\Repositories\HomeRepository;
use App\Validators\CourierValidator;
use App\Entities\Courier;
use Auth;

/**
 * Class CouriersController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class CouriersController extends Controller
{
    /**
     * @var CourierRepository
     */
    protected $courierRepository;

    /**
     * @var HomeRepository
     */
    protected $homeRepository;

    /**
     * @var CourierValidator
     */
    protected $validator;

    /**
     * CouriersController constructor.
     *
     * @param CourierRepository $courierRepository
     * @param HomeRepository $homeRepository
     * @param CourierValidator $validator
     */
    public function __construct(
        CourierRepository $courierRepository,
        HomeRepository $homeRepository,
        CourierValidator $validator)
    {
        $this->courierRepository = $courierRepository;
        $this->homeRepository = $homeRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$this->courierRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));*/
        //$couriers = $this->courierRepository->all();

        $vendor_id = isset($data['vendor_id']) ? $data['vendor_id'] : '';

        // Get list of order based on login user
        if (Auth::guard('vendor')->check()) {
            $vendor_id = Auth::guard('vendor')->user()->vendor_id;
            $orders = $this->courierRepository->getOrderListByVendor($vendor_id);
        }

        // Get list of order based on admin
        if (Auth::guard('admin')->check()) {
            $orders = $this->courierRepository->getOrderListByVendor();
        }

        // Get courier dropdown list
        $couriers = Courier::where('is_active', '1')->pluck('courier_name', 'courier_id');

        // Get static courier status list
        $status = $this->homeRepository->getCourierStatusList();

        return view('admin.couriers.index', compact('orders', 'vendor_id', 'status', 'couriers'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  CourierCreateRequest $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(CourierCreateRequest $request)
    // {
    //     try {

    //         $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

    //         // Create new courier
    //         $courier = $this->courierRepository->create($request->all());
    //         $response = [
    //             'message' => 'Courier created.',
    //             'data'    => $courier->toArray(),
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
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $courier = $this->courierRepository->find($id);
    //     return view('couriers.show', compact('courier'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int $id
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $courier = $this->courierRepository->find($id);

    //     return view('couriers.edit', compact('courier'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  CourierUpdateRequest $request
     * @return Response
     */
    public function update(CourierUpdateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update Courier
            $this->courierRepository->updateShippingInfo($request->all());
            $response = [
                'message' => 'Shipment Information updated successfully.',
                'status' => 'success',
            ];

            return redirect()->route('success_order_list')->with('response', $response);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int $id
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $deleted = $this->courierRepository->delete($id);

    //     if (request()->wantsJson()) {

    //         return response()->json([
    //             'message' => 'Courier deleted.',
    //             'deleted' => $deleted,
    //         ]);
    //     }

    //     return redirect()->back()->with('message', 'Courier deleted.');
    // }

    /**
     * Get courier and shipping info using order id by ajax
     *
     * @param  int $order_id
     * @return \Illuminate\Http\Response
     */
    public function getCourierInfoByAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $couriers = $this->courierRepository->getCourierInfoByOrderId($request['order_id']);
            if ($couriers) {
                return response()->json([
                    'success' => true,
                    'data'  => $couriers->toArray(),
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'data'  => [],
                ]);
            }
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }
}
