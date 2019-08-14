<?php

namespace App\Http\Controllers\V1\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Repositories\OrderRepository;
use App\Validators\OrderValidator;
use Softon\Indipay\Facades\Indipay;
use App\Entities\UserAddress;
use App\Entities\State;
use App\Entities\User;
use \Cart as Cart;
use Config;
use Session;
use Auth;
use Log;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers\V1\Frontend;
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $orderRepository
     * @param OrderValidator $validator
     */
    public function __construct(OrderRepository $orderRepository, OrderValidator $validator)
    {
        $this->orderRepository = $orderRepository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $this->orderRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    //     $orders = $this->orderRepository->all();

    //     if (request()->wantsJson()) {

    //         return response()->json([
    //             'data' => $orders,
    //         ]);
    //     }

    //     return view('orders.index', compact('orders'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(OrderCreateRequest $request)
    // {
    //     try {
    //         $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
    //         $order = $this->orderRepository->checkoutProcess($request->all());
    //         if ($order) {
    //             Session::flash('message', 'Order created successfully!');
    //             Session::flash('alert-class', 'alert-success'); 
    //             $response = [
    //                 'message' => 'Order created successfully.',
    //             ];
    //         } else {
    //             Session::flash('message', 'Checkout process failed!');
    //             Session::flash('alert-class', 'alert-danger'); 
    //             $response = [
    //                 'message' => 'Checkout process failed.',
    //             ];
    //         }
            
    //         return redirect('cart')->with('response', $response);
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $order = $this->orderRepository->find($id);

    //     if (request()->wantsJson()) {

    //         return response()->json([
    //             'data' => $order,
    //         ]);
    //     }

    //     return view('orders.show', compact('order'));
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
    //     $order = $this->orderRepository->find($id);

    //     return view('orders.edit', compact('order'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    // public function update(OrderUpdateRequest $request, $id)
    // {
    //     try {

    //         $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

    //         $order = $this->orderRepository->update($request->all(), $id);

    //         $response = [
    //             'message' => 'Order updated.',
    //             'data'    => $order->toArray(),
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
    //     $deleted = $this->orderRepository->delete($id);

    //     if (request()->wantsJson()) {

    //         return response()->json([
    //             'message' => 'Order deleted.',
    //             'deleted' => $deleted,
    //         ]);
    //     }

    //     return redirect()->back()->with('message', 'Order deleted.');
    // }

    /**
     * Show the page to select address
     */
    public function selectAddress()
    {
        Log::channel('loginfo')->info('Show the page to select address.',['Frontend/OrdersController/selectAddress']);
        $user_id = Auth::guard('user')->user()->user_id;

        // Get state dropdown list
        $states = State::pluck('name','state_id')->all();

        // Get user address list
        Log::channel('loginfo')->info('Get user address list.',['getUserAddresslist']);
        $user_address = $this->orderRepository->getUserAddresslist($user_id);
        return view('front.checkout', compact('states', 'user_address'));
    }

    /**
     * Process Checkout functionality
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function processCheckout(Request $request)
    {
        Log::channel('loginfo')->info('Process Checkout functionality.',['Frontend/OrdersController/processCheckout']);

        // Get user institution
        Log::channel('loginfo')->info('Get user institution.',['getUserInstitution']);
        $user_institution = $this->orderRepository->getUserInstitution();
        if (!$user_institution) {
            $response = [
                'message' => 'Please select institution.',
                'status' => 'danger',
            ];
            return redirect()->route('user_profile')->with('response', $response);
        }

        // Create order then checkout process
        Log::channel('loginfo')->info('Create order then checkout process.',['checkoutProcess']);
        $order = $this->orderRepository->checkoutProcess($request->all());
        if (!empty($order)) {
            // Get user address by id
            Log::channel('loginfo')->info('Create order then checkout process.',['getUserAddressById']);
            $address = $this->orderRepository->getUserAddressById($order['shipping_address_id']);

            /* All Required Parameters by your Gateway */
            $user_id = Auth::guard('user')->user()->user_id;

            $user = User::find($user_id);
            $parameters = [
                'tid' => $order['transaction_id'],
                'order_id' => $order['order_number'],
                'amount' => $order['order_total_price'],
                'billing_name' => $address['fullname'],
                'billing_address' => $address['address1'],
                'billing_city' => $address['city'],
                'billing_state' => $address['state']['name'],
                'billing_zip' => $address['pin'],
                'billing_country' => $address['country']['name'],
                'billing_tel' => $address['phone'],
                'billing_email' => $user['email'],
                // 'currency' => 'USD',
                // 'redirect_url' => 'http://103.204.192.187:8080/flinnt/public/order/response/checkout',
                // 'cancel_url' => 'http://103.204.192.187:8080/flinnt/public/cart/process/checkout',
                // 'language' => 'EN',
                // 'merchant_id' => 'M_demos_17',
            ];

            //Redirect to CCAvenue process
            Log::channel('loginfo')->info('CCAvenue process.',['param' => $parameters]);
            $order = Indipay::gateway('CCAvenue')->prepare($parameters);

            /*echo "<pre>";
            print_r($order);
            die;*/
            return Indipay::process($order);
        } else {
            Session::flash('message', 'Payment process failed!');
            Session::flash('alert-class', 'alert-danger'); 
            $response = [
                'message' => 'Payment process failed.',
            ];
            return redirect()->route('cart')->with('response', $response);
        }
    }

    /**
     * Response functionality
     *
     * @return \Illuminate\Http\Response
     */
    public function response(Request $request)
    {
        // For default Gateway
        Log::channel('loginfo')->info('CCAvenue Gateway response.',['Frontend/OrdersController/response']);
        $response = Indipay::gateway('CCAvenue')->response($request);

        // Update order after gateway response
        Log::channel('loginfo')->info('Update order after gateway response.',['updateOrder']);
        $order = $this->orderRepository->updateOrder($response);
        // echo "<pre>";
        // print_r($response);
        // die;
        // $response['order_id'] = '136145898';
        // $response['tracking_id'] = '308004754454';
        // $response['order_status'] = 'Aborted';
        // $response['status_message'] = 'money';
        // $response['currency'] = 'INR';
        // $response['amount'] = '335.00';
        // $response['billing_name'] = 'vijay';
        // $response['billing_address'] = '604,iscon elegance,sg highway';
        // $response['billing_city'] = 'Ahmedabad';
        // $response['billing_state'] = 'Gujarat';
        // $response['billing_zip'] = '380015';
        // $response['billing_country'] = 'India';
        // $response['billing_tel'] = '8200451123';
        // $response['mer_amount'] = '335.00';


        switch ($response['order_status']) {
            case 'Success':
                Session::flash('message', 'Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.');
                Session::flash('alert-class', 'alert-success'); 
                break;
            
            case 'Aborted':
                Session::flash('message', 'Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail.');
                Session::flash('alert-class', 'alert-success'); 
                break;

            case 'Failure':
                Session::flash('message', 'Thank you for shopping with us.However,the transaction has been declined.');
                Session::flash('alert-class', 'alert-danger'); 
                break;       

            default:
                Session::flash('message', 'Security Error. Illegal access detected.');
                Session::flash('alert-class', 'alert-danger'); 
                break;
        }
        return view('front.response', compact('response'));
    }

    /**
     * Store a newly created shipping address.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeAddress(Request $request)
    {
        try {
            $user_id = Auth::guard('user')->user()->user_id;

            $data = $request->all();
            $data['country_id'] = 1;
            $data['user_id'] = $user_id;

            // Add Address
            Log::channel('loginfo')->info('Add address.',['Frontend/OrdersController/storeAddress']);
            $address = $this->orderRepository->createUserAddress($data);
            if ($address) {
                Session::flash('message', 'Address created successfully!');
                Session::flash('alert-class', 'alert-success'); 
                $response = [
                    'message' => 'Address created successfully.',
                ];
            } else {
                Session::flash('message', 'Address store process failed!');
                Session::flash('alert-class', 'alert-danger'); 
                $response = [
                    'message' => 'Address store process failed.',
                ];
            }
            
            return redirect()->route('review_pay', $address['user_address_id'])->with('response', $response);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Log::channel('loginfo')->error('create shipping address.',[$e->getMessageBag()]);
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Show the form for editing the address resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editAddress($id)
    {
        // Show edit address
        Log::channel('loginfo')->info('Show edit address.',['Frontend/OrdersController/editAddress']);
        $address = $this->orderRepository->getUserAddressById($id);

        $states = State::pluck('name','state_id')->all();
        return view('front.address_edit', compact('address', 'states'));
    }

    /**
     * Address update process
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(Request $request, $id)
    {
        $data = $request->all();

        // Update address process
        Log::channel('loginfo')->info('Update address process.',['Frontend/OrdersController/updateAddress']);
        $address = $this->orderRepository->updateUserAddressById($data, $id);
        if ($address) {
            Session::flash('message', 'Address updated successfully!');
            Session::flash('alert-class', 'alert-success'); 
            $response = [
                'message' => 'Address updated successfully.',
            ];
        } else {
            Session::flash('message', 'Address update process failed!');
            Session::flash('alert-class', 'alert-danger'); 
            $response = [
                'message' => 'Address update process failed.',
            ];
        }
        return redirect()->route('review_pay', $address['user_address_id'])->with('response', $response);
    }

    /**
     * Remove the user address from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAddress($id)
    {
        // Delete address process
        Log::channel('loginfo')->info('Delete address process.',['Frontend/OrdersController/destroyAddress']);
        $deleted = UserAddress::destroy($id);
        if ($deleted) {
            Session::flash('message', 'Address deleted successfully!');
            Session::flash('alert-class', 'alert-success'); 
            $response = [
                'message' => 'Address deleted successfully.',
            ];
        } else {
            Session::flash('message', 'Address delete process failed!');
            Session::flash('alert-class', 'alert-danger'); 
            $response = [
                'message' => 'Address delete process failed.',
            ];
        }
        return redirect()->route('select_address')->with('response', $response);
    }

    /**
     * Show the form for order review and pay process
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function processReviewPay($id)
    {
        Log::channel('loginfo')->info('Show the form for order review and pay.',['Frontend/OrdersController/processReviewPay']);
        // Get cart details
        $user_id = Auth::guard('user')->user()->user_id;

        Cart::instance('cartlist')->restore($user_id.'_cart');
        Cart::instance('cartlist')->store($user_id.'_cart');
        $carts = Cart::instance('cartlist')->content();

        // Get user address by address id
        Log::channel('loginfo')->info('Get user address by address id.',['getUserAddressById']);
        $address = $this->orderRepository->getUserAddressById($id);
        return view('front.review_pay', compact('address', 'carts'));
    }

    /**
     * Do re-try payment process of failed orders
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doTryAgainPayment(Request $request, $order_id)
    {
        Log::channel('loginfo')->info('Do re-try payment process.',['Frontend/OrdersController/doTryAgainPayment']);
        $order = $this->orderRepository->updateOrderTransaction($order_id);
        if (!empty($order)) {
            $address = $this->orderRepository->getUserAddressById($order['shipping_address_id']);

            /* All Required Parameters by your Gateway */
            $user_id = Auth::guard('user')->user()->user_id;

            $user = User::find($user_id);
            $parameters = [
                'tid' => $order['transaction_id'],
                'order_id' => $order['order_number'],
                'amount' => $order['order_total_price'],
                'billing_name' => $address['fullname'],
                'billing_address' => $address['address1'],
                'billing_city' => $address['city'],
                'billing_state' => $address['state']['name'],
                'billing_zip' => $address['pin'],
                'billing_country' => $address['country']['name'],
                'billing_tel' => $address['phone'],
                'billing_email' => $user['email'],
                // 'currency' => 'USD',
                // 'redirect_url' => 'http://103.204.192.187:8080/flinnt/public/order/response/checkout',
                // 'cancel_url' => 'http://103.204.192.187:8080/flinnt/public/cart/process/checkout',
                // 'language' => 'EN',
                // 'merchant_id' => 'M_demos_17',
            ];

            Log::channel('loginfo')->info('CCAvenue payment process.',['param' => $parameters]);
            $order = Indipay::gateway('CCAvenue')->prepare($parameters);
            /*echo "<pre>";
            print_r($order);
            die;*/
            return Indipay::process($order);
        } else {
            Session::flash('message', 'Payment process failed!');
            Session::flash('alert-class', 'alert-danger'); 
            $response = [
                'message' => 'Payment process failed.',
            ];
            return redirect()->route('cart')->with('response', $response);
        }
    }
}
