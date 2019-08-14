<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Controllers\V1\Backend\BaseController;
use App\Repositories\OrderRepository;
use App\Repositories\HomeRepository;
use App\Validators\OrderValidator;
use App\Entities\Institution;
use App\Entities\Vendor;
use \Cart as Cart;
use Session;
use Config;
use PDF;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var HomeRepository
     */
    protected $homeRepository;

    /**
     * @var BaseController
     */
    protected $baseController;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $orderRepository
     * @param HomeRepository $homeRepository
     * @param BaseController $baseController
     * @param OrderValidator $validator
     */
    public function __construct(OrderRepository $orderRepository, HomeRepository $homeRepository, BaseController $baseController,OrderValidator $validator)
    {
        $this->orderRepository = $orderRepository;
        $this->homeRepository = $homeRepository;
        $this->baseController = $baseController;
        $this->validator = $validator;
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $this->orderRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    //     $orders = $this->orderRepository->getOrderListForVendor();
    //     return view('orders.index', compact('orders'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetailsByOrderNumber($ordernum)
    {
        $data = [];
        $pdf_data = $this->orderRepository->getOrderDetailsByOrderNumber($ordernum);
        $pdf_data['in_word'] = $this->baseController->getIndianCurrency($pdf_data['order_total_price']);
        $data['pdf_data'] = $pdf_data;
        $pdf = PDF::loadView('front.partials.pdf', $data);
        return $pdf->stream('invoice.pdf');
    }

    /**
     * Display sell order listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSellOrderList(Request $request)
    {
        $this->orderRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $order_status = array (
            '1' => 'Awaiting payment',
            '2' => 'Partially Paid',
            '3' => 'Paid',
            '4' => 'Declined',
            '5' => 'Cancelled',
            '6' => 'Refunded'
        );

        $institutions = array (
            '1' => 'Tiger',
            '2' => 'Garrett',
            '3' => 'Ashton',
            '4' => 'Cedric',
            '5' => 'Airi'
        );

        $vendors = array (
            '1' => 'Brielle',
            '2' => 'Herrod',
            '3' => 'Rhona'
        );
        $request_data = $request->all();
        $orders = $this->orderRepository->getSellOrderList($request->all());
        $order_status = $this->homeRepository->getPaymentStatusList();
        $institutions = Institution::where('is_active', 1)->pluck('institution_name', 'institution_id');
        $vendors = Vendor::where('is_active', 1)->pluck('vendor_name', 'vendor_id');

        return view('admin.vendor.sell_order_list', compact('orders', 'order_status', 'institutions', 'vendors', 'request_data'));
    }
}
