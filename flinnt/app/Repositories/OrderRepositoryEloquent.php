<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use App\Validators\OrderValidator;
use App\Entities\InstitutionBooksetVendorPrice;
use App\Entities\InstitutionBookVendorPrice;
use App\Entities\OrderCourier;
use App\Entities\UserAddress;
use App\Entities\OrderDetail;
use App\Entities\Order;
use App\Entities\User;
use \Cart as Cart;
use Carbon\Carbon;
use Config;
use Auth;
use Log;
use DB;

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return OrderValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get sell order list
     *
     * @param array $data
     * @return int $orders
     */
    public function getSellOrderList($data)
    {
        //DB::enableQueryLog();
        if (isset($data['order_date_range'])) {
            $date = explode('-', $data['order_date_range']);

            $start_date = trim($date[0]);
            $start_date = date('Y-m-d H:i:s', strtotime($start_date));

            $end_date = trim($date[1]);
            $end_date = date('Y-m-d H:i:s', strtotime($end_date));
        }

        $orders = Order::with(['orderline.vendor' => function ($query) {
                                    $query->select('vendor_id', 'vendor_name');
                            }, 'institution' => function ($query) {
                                    $query->select('institution_id', 'institution_name');
                            }, 'useraddress' => function ($query) {
                                    $query->select('user_address_id','fullname');
                            }, 'ordercourier' => function ($query) {
                                    $query-> select('order_courier_id', 'status_id', 'send_at', 'deliver_at', 'order_id', 'courier_id');
                            }, 'ordercourier.courier']);

        if (isset($data['order_date_range'])) {
            $orders = $orders->whereBetween('order_date', [$start_date, $end_date]);
        }

        if (isset($data['order_status'])) {
            $orders = $orders->where('order_status', $data['order_status']);
        }

        if (isset($data['institution_id'])) {
            $orders->whereHas('institution', function ($query) use ($data) {
                $query->where('institution_id', $data['institution_id']);
            });
        }

        if (isset($data['vendor_id'])) {
            $orders->whereHas('orderline.vendor', function ($query)  use ($data){
                $query->where('vendor_id', $data['vendor_id']);
            });
        }
                        
        $orders = $orders->select('order_id', 'institution_id', 'shipping_address_id', 'order_number', 'transaction_id', 'order_date', 'order_total_price as final_price', 'order_status')
            ->distinct('order.order_id')->orderBy('order.order_id', 'ASC')
            ->get();
        //dd(DB::getQueryLog());
        return $orders;


        /*$orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->leftjoin('institution', 'institution.institution_id', '=', 'order.institution_id')
            ->leftjoin('vendor', 'vendor.vendor_id', '=', 'order_detail.vendor_id')
            ->leftjoin('user_address', 'user_address.user_address_id', '=', 'order.shipping_address_id')
            ->leftjoin('order_courier', 'order_courier.order_id', '=', 'order.order_id')
            ->leftjoin('courier', 'courier.courier_id', '=', 'order_courier.courier_id');

        $orders = $orders->select('order.order_id','order.order_number', 'order.transaction_id', 'user_address.fullname', 'order_courier.status_id', 'send_at', 'deliver_at', 'institution_name', 'courier_name', 'docket_number', 'tracking_url', 'institution_name', 'institution.institution_id', 'vendor_name', 'vendor.vendor_id', 'order_date', 'order_total_price as final_price', 'order_status');

        if (isset($data['order_date_range'])) {
            $orders = $orders->whereBetween('order_date', [$start_date, $end_date]);
        }

        if (isset($data['order_status'])) {
            $orders = $orders->where('order_status', $data['order_status']);
        }

        if (isset($data['institution_id'])) {
            $orders = $orders->where('institution.institution_id', $data['institution_id']);
        }

        if (isset($data['vendor_id'])) {
            $orders = $orders->where('vendor.vendor_id', $data['vendor_id']);
        }

        $orders = $orders->distinct('order.order_id')->orderBy('order.order_id', 'ASC')->get();
        //dd(DB::getQueryLog());
        return $orders;*/
    }


    /**
     * Front side function
     */


   /**
     * Process to checkout cart
     *
     * @param  array $data
     * @return array $order
     */
    public function checkoutProcess($data)
    {
        try {
            DB::beginTransaction();
            $address_id = $data['shipping_address_id'];
            $order = $this->createOrder($address_id);
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('Process to checkout cart.',['OrderRepository/checkoutProcess', $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Create order
     *
     * @param int $address_id
     * @return array $order
     */
    public function createOrder($address_id)
    {
        try {
            DB::beginTransaction();
            $user_id = Auth::guard('user')->user()->user_id;

            $user_data = User::find($user_id);
            // Create new order
            $carts = Cart::instance('cartlist')->content()->toArray();
            // Create order lines of order
            if (!empty($carts) || count($carts) > 0) {
                $order = new Order();
                $order->user_id = $user_id;
                $order->institution_id = $user_data['institution_id'];
                $order->shipping_address_id = $address_id;
                $order->order_number = Carbon::now()->format('ymdHis');
                $order->order_qty = Cart::instance('cartlist')->count();
                $order->order_total_price = Cart::instance('cartlist')->total();
                $order->transaction_id = Carbon::now()->timestamp;
                $order->order_status  = 1;
                $order->order_date  = Carbon::now();
                $order->is_active  = 1;
                $order->save();
                // if order is created then create order lines
                if (isset($order)) {
                    $order_lines = $this->createOrderLines($order->order_id);
                }
            }
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('Create order.',['OrderRepository/createOrder', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Create order lines
     *
     * @param int $order_id
     * @return array $carts
     */
    public function createOrderLines($order_id)
    {
        try {
            DB::beginTransaction();
            $user_id = Auth::guard('user')->user()->user_id;

            $carts = Cart::instance('cartlist')->content()->toArray();
            // Create order lines of order
            if (!empty($carts) || count($carts) > 0) {
                foreach ($carts as $key => $cart) {
                    $order_lines = new OrderDetail();
                    $order_lines->order_id = $order_id;
                    $order_lines->product_id = $cart['id'];
                    $order_lines->vendor_id = $this->getVendorId($cart['id'], $cart['options']['type']);
                    $order_lines->product_name = $cart['name'];
                    $order_lines->product_type = $this->getProductTypeId($cart['options']['type']);
                    $order_lines->sale_price = $cart['price'];
                    $order_lines->qty = $cart['qty'];
                    $order_lines->discount_id = 1;
                    $order_lines->discount_price = 0;
                    $order_lines->final_price = $cart['subtotal'];;
                    $order_lines->save();
                }

                // after order lines created delete cart
                if (isset($order_lines)) {
                    Cart::instance('cartlist')->restore($user_id.'_cart');
                    Cart::instance('cartlist')->destroy();
                    Cart::instance('cartlist')->store($user_id.'_cart');
                }
            }
            DB::commit();
            return $carts;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('Create order lines.',['OrderRepository/createOrderLines', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update order
     *
     * @param array $data
     * @return array $order
     */
    public function updateOrder($data)
    {
        try {
            DB::beginTransaction();
            $order = [];
            $user_id = Auth::guard('user')->user()->user_id;

            // Update order
            if (!empty($data) || count($data) > 0) {
                switch ($data['order_status']) {
                    case 'Success':
                            $status = '2';
                        break;
                    
                    case 'Aborted':
                            $status = '3';
                        break;

                    case 'Failure':
                            $status = '3';
                        break;       

                    default:
                            $status = '1';
                        break;
                }

                $order = Order::where('order_number', $data['order_id'])
                    ->update(['order_status' => $status, 'transaction_id' => $data['tracking_id'], 'payment_id' => $data['bank_ref_no']]);
            }
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('Update order.',['OrderRepository/updateOrder', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get product type id by product type value
     *
     * @param string $type
     * @return int $key
     */
    public function getProductTypeId($type)
    {
        $array = array ('1' => 'book', '2' => 'bookset', '3' => 'stationary');
        return $key = array_search($type, $array);
    }

    /**
     * Store user's shipping address
     *
     * @param array $data
     * @return array $user_address
     */
    public function createUserAddress($data)
    {
        try {
            $user_address = new UserAddress();
            $user_address->fill($data);
            $user_address->save();
            return $user_address;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Store user shipping address.',['OrderRepository/createUserAddress', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get address list by user id
     *
     * @param int $user_id
     * @return array $user_address
     */
    public function getUserAddresslist($user_id)
    {
        return UserAddress::join('state', 'user_address.state_id', '=', 'state.state_id')
                                ->where('user_id', $user_id)->get()->toArray();
    }
    
    /**
     * Get user address by user id
     *
     * @param  int $id
     * @return array $user_address
     */
    public function getUserAddressById($id)
    {
        return UserAddress::with(['state' => function ($query) {
                                    $query->select('state_id', 'name');
                                },'country' => function ($query) {
                                    $query->select('country_id', 'name');
                                }])
                                ->select('user_address_id', 'user_id', 'country_id', 'state_id', 'fullname', 'address1', 'address2', 'city', 'address_type', 'pin', 'phone')
                                ->find($id)
                                ->toArray();

        /*$user_address = UserAddress::join('state', 'user_address.state_id', '=', 'state.state_id')
                ->join('country', 'user_address.country_id', '=', 'country.country_id')
                ->select('user_id','fullname','address1','address2','city','state.state_id','country.country_id','address_type','pin','phone','state.name as name','country.name as country_name','user_address_id')
                ->find($id)
                ->toArray();
        return $user_address;*/
    }

    /**
     * Process to update user address
     *
     * @param  array $data
     * @param  int $id
     * @return array $user_address
     */
    public function updateUserAddressById($data, $id)
    {
        try {
            $user_address = UserAddress::find($id);
            if ($user_address) {
                $user_address->fill($data);
                $user_address->save();
            }
            return $user_address;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Process to update user address.',['OrderRepository/updateUserAddressById', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get vendor id by product id & product type
     *
     * @param  int $product_id
     * @param  string $product_type
     * @return array $bookset_vendor
     */
    public function getVendorId($product_id, $product_type)
    {
        try {
            $vendor_id = '';
            if ($product_type == 'book') {
                $book_vendor = InstitutionBookVendorPrice::find($product_id);
                if ($book_vendor) {
                    return $book_vendor['vendor_id'];
                }
            } 

            if ($product_type == 'bookset') {
                $bookset_vendor = InstitutionBooksetVendorPrice::find($product_id);
                if ($bookset_vendor) {
                    return $bookset_vendor['vendor_id'];
                }
            }
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Get vendor id by product id, product type.',['OrderRepository/getVendorId', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get order details by order id
     *
     * @param  int $order_number
     * @return array $orders
     */
    public function getOrderDetailsByOrderNumber($order_number)
    {
        try {
            $vendor_id = '';
            if (Auth::guard('vendor')->check()) {
                // Get list of order based on login user
                $vendor_id = Auth::guard('vendor')->user()->vendor_id;
            }

            $orders = Order::with(['orderline' => function ($query) use ($vendor_id) {
                                    if ($vendor_id) {
                                        $query->where('vendor_id', $vendor_id);
                                    }
                                    $query->select('order_id', 'vendor_id', 'product_name', 'sale_price', 'qty', 'final_price');
                                }, 'orderline.vendor' => function ($query) {
                                    $query->select('vendor_id', 'vendor_name', 'vendor_address1', 'vendor_address2', 'vendor_city', 'vendor_state_id', 'vendor_country_id');
                                }, 'orderline.vendor.state' => function ($query) {
                                    $query->select('state_id', 'name');
                                }, 'orderline.vendor.country' => function ($query) {
                                    $query->select('country_id', 'name');
                                }, 'useraddress' => function ($query) {
                                    $query->select('user_address_id', 'fullname', 'address1', 'address2', 'city', 'state_id', 'country_id', 'address_type', 'pin', 'phone');
                                }, 'useraddress.state' => function ($query) {
                                    $query->select('state_id', 'name');
                                }, 'useraddress.country' => function ($query) {
                                    $query->select('country_id', 'name');
                                }])
                                ->where('order_number', $order_number)
                                ->select('order_id', 'user_id', 'shipping_address_id', 'order_number','order_date')
                                ->first();

            $orders['order_total_price'] = $orders->orderline->sum('final_price');


            /*$orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
                ->leftjoin('user_address', 'user_address.user_address_id', '=', 'order.shipping_address_id')
                ->leftjoin('state', 'user_address.state_id', '=', 'state.state_id')
                ->leftjoin('country', 'user_address.country_id', '=', 'country.country_id')
                ->leftjoin('vendor', 'vendor.vendor_id', '=', 'order_detail.vendor_id')
                ->leftjoin(DB::raw('str_state as vs'), 'vendor.vendor_state_id', '=', DB::raw('vs.state_id'))
                ->leftjoin(DB::raw('str_country as vc'), 'vendor.vendor_country_id', '=', DB::raw('vs.country_id'))
                ->where('order.order_number', $order_number);

            if (Auth::guard('vendor')->check()) {
                // Get list of order based on login user
                $vendor_id = Auth::guard('vendor')->user()->vendor_id;
                $orders = $orders->where('order_detail.vendor_id', $vendor_id);
                $orders = $orders->selectRaw('str_order.order_number, str_order.order_date, str_order_detail.product_name, str_order_detail.product_name, str_order_detail.sale_price, str_order_detail.qty, str_order_detail.final_price, vendor_name, vendor_address1, vendor_address2, vendor_city, vs.name as vs_name, vc.name as vc_name, str_order.user_id, fullname, address1, address2, city, str_state.state_id , str_country.country_id, address_type , pin, phone , str_state.name as name , str_country.name as country_name , user_address_id, (SELECT SUM(a.final_price) FROM str_order_detail a WHERE a.order_id=str_order.order_id and str_order.order_number = '.$order_number.'  and a.vendor_id = '.$vendor_id.') AS order_total_price');
            } else {
                $orders = $orders->selectRaw('str_order.order_number, str_order.order_date, str_order_detail.product_name, str_order_detail.product_name, str_order_detail.sale_price, str_order_detail.qty, str_order_detail.final_price, vendor_name, vendor_address1, vendor_address2, vendor_city, vs.name as vs_name, vc.name as vc_name, str_order.user_id, fullname, address1, address2, city, str_state.state_id , str_country.country_id, address_type , pin, phone , str_state.name as name , str_country.name as country_name , user_address_id, (SELECT SUM(a.final_price) FROM str_order_detail a WHERE a.order_id=str_order.order_id and str_order.order_number = '.$order_number.') AS order_total_price');
            }

            $orders = $orders->get()->toArray();*/
            /*echo "<pre>";
            print_r($orders->toArray());
            die;*/
            return $orders;
        } catch (\Exception $e) {
            /*print_r($e->getMessage());
            die;*/
            Log::channel('loginfo')
                ->error('Get order details by order id.',['OrderRepository/getOrderDetailsByOrderNumber', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update order transection id
     *
     * @param int $order_id
     * @return array $order
     */
    public function updateOrderTransaction($order_id)
    {
        try {
        	$order = Order::find($order_id);
        	$order->transaction_id = Carbon::now()->timestamp;
        	$order->save();
            return $order;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update order transection id.',['OrderRepository/updateOrderTransaction', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get user's institution
     *
     * @return array $user_data
     */
    public function getUserInstitution()
    {
        $user_id = Auth::guard('user')->user()->user_id;
        $user_data = User::find($user_id);
        return $user_data['institution_id'];
    }

    /**
     * Get List of Last 5 Transactions
     *
     * @return array $orders
     */
    public function getLastTransactionSummary()
    {
        return Order::with(['institution' => function ($query) {
                            $query->select('institution_id', 'institution_name');
                        }, 'ordercourier' => function ($query) {
                            $query->select('courier_id', 'status_id', 'order_id');
                        }])
                        ->select('order_id', 'institution_id', 'shipping_address_id','order_number', 'transaction_id', 'order_date', 'order_total_price', 'order_status')
                        ->orderBy('order_id', 'DESC')
                        ->take(5)
                        ->get();


        /*$orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->leftjoin('institution', 'institution.institution_id', '=', 'order.institution_id')
            ->leftjoin('user_address', 'user_address.user_address_id', '=', 'order.shipping_address_id')
            ->leftjoin('order_courier', 'order_courier.order_id', '=', 'order.order_id')
            ->leftjoin('courier', 'courier.courier_id', '=', 'order_courier.courier_id');

        $orders = $orders->select('order.order_id', 'order.order_number', 'order.transaction_id', 'order_courier.status_id', 'institution_name', 'institution.institution_id', 'order_date', 'order_total_price', 'order_status');

        $orders = $orders->distinct('order.order_id')
                ->orderBy('order.order_id', 'DESC')
                ->take(5)
                ->get();

        return $orders;*/
    }

    /**
     * Get List of top 5 vendors based on orders
     *
     * @return array $vendors
     */
    public function getTopVendors()
    {
        //DB::enableQueryLog();
        /*return Order::with(['orderline' => function ($query) {
                                $query->select('order_id', 'vendor_id', 'final_price', DB::raw('SUM(final_price) as total_price, COUNT(distinct(order_id)) as total_order'))->groupBy('vendor_id');
                            },'orderline.vendor' => function ($query) {
                                $query->select('vendor_id', 'vendor_name');
                            }])
                            ->select('order_id')
                            ->where('order_status', 2)
                            ->take(5)
                            ->get();*/

        $vendors = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->join('vendor', 'vendor.vendor_id', '=', 'order_detail.vendor_id')
            ->where('order_status', 2);

        $vendors = $vendors->select('vendor.vendor_name', DB::raw('COUNT(distinct(str_order.order_id)) as total_order, SUM(str_order_detail.final_price) as total_price'))
            ->groupBy('vendor.vendor_name')
            ->orderBy('total_order', 'DESC')
            ->orderBy('total_price', 'DESC')
            ->take(5)
            ->get();

        //dd(DB::getQueryLog($vendors));
        return $vendors;
    }

    /**
     * Count payment status list based on orders
     *
     * @return array $vendors
     */
    public function getPaymentStatusCount()
    {
        $orders = Order::select( DB::raw('COUNT(str_order.order_status) as status_count, order_status') )
            ->groupBy('order_status')
            ->get()->toArray();

        return $orders;
    }

    /**
     * Count delivery status list based on orders
     *
     * @return array $vendors
     */
    public function getDeliveryStatusCount()
    {
        $orders = OrderCourier::select( DB::raw('COUNT(str_order_courier.status_id) as status_count, status_id') )
            ->groupBy('status_id')
            ->get()->toArray();

        $order_ids = OrderCourier::pluck('order_id')->all();
        $pending_ids = Order::where('order_status', 2)
            ->whereNotIn('order_id', $order_ids)->pluck('order_id')->count();
    
        if ($pending_ids > 0) {
            $pending_status = [];
            $pending_status['status_count'] = $pending_ids;
            $pending_status['status_id'] = 0;
            $orders[] = $pending_status;
        }

        return $orders;
    }

    /**
     * Count delivery status list based on orders
     *
     * @return array $vendors
     */
    public function countTotalRevenue()
    {
        $orders = Order::where('order_status', 2)
            ->select(DB::raw('ifnull(SUM(str_order.order_total_price),0) as total_price'))
            ->first();

        return $orders;
    }

    /**
     * Get List of Last 5 Transactions for login vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function getLastTransactionSummaryForVendor($vendor_id)
    {
        return OrderDetail::with(['order' => function ($query) {
                            $query->select('order_id', 'institution_id','order_number', 'transaction_id', 'order_date', 'order_status');
                        }, 'order.institution' => function ($query) {
                                $query->select('institution_id', 'institution_name');
                        }, 'order.ordercourier' => function ($query) {
                            $query->select('courier_id', 'status_id', 'order_id');
                        }])
                        ->where('vendor_id', $vendor_id)
                        ->select(['order_id', DB::raw('SUM(final_price) as order_total_price')])
                        ->groupBy('order_id')
                        ->orderBy('order_id', 'DESC')
                        ->take(5)
                        ->get();

        // $orders = OrderDetail::leftjoin('order', 'order.order_id', '=', 'order_detail.order_id')
        //     ->leftjoin('institution', 'institution.institution_id', '=', 'order.institution_id')
        //     ->leftjoin('order_courier', 'order_courier.order_id', '=', 'order.order_id')
        //     ->leftjoin('courier', 'courier.courier_id', '=', 'order_courier.courier_id');

        // $orders = $orders->selectRaw('str_order.order_id, str_order.order_number, str_order.transaction_id, str_order.order_date, str_order_courier.status_id, institution_name, order_status, (SELECT SUM(a.final_price) FROM str_order_detail a WHERE a.order_id=str_order.order_id and a.vendor_id = '.$vendor_id.') AS order_total_price');
        
        // $orders = $orders->where('order_detail.vendor_id', $vendor_id);

        // $orders = $orders->distinct('order.order_id')
        //         ->orderBy('order.order_id', 'DESC')
        //         ->take(5)
        //         ->get();

        // return $orders;
    }

    /**
     * Get List of top 5 institutions based on orders for login vendor
     *
     * @param int $vendor_id
     * @return array $vendors
     */
    public function getTopInstitutions($vendor_id)
    {
        $vendors = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->join('institution', 'institution.institution_id', '=', 'order.institution_id')
            ->where('order_detail.vendor_id', $vendor_id)
            ->where('order_status', 2);

        $vendors = $vendors->select('institution.institution_name', DB::raw('COUNT(distinct(str_order.order_id)) as total_order, SUM(str_order_detail.final_price) as total_price'))
            ->groupBy('institution.institution_name')
            ->orderBy('total_order', 'DESC')
            ->orderBy('total_price', 'DESC')
            ->take(5)
            ->get();

        return $vendors;
    }

    /**
     * Count payment status list based on orders for vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function getPaymentStatusCountForVendor($vendor_id)
    {
        return Order::whereHas('orderline', function ($query) use ($vendor_id) {
                        $query->where('vendor_id', $vendor_id);
                    })
                    ->select('order_status', DB::raw('count(order_status) as status_count'))
                    ->groupBy('order_status')
                    ->get()->toArray();

        // $orders = Order::join('order_detail', 'order_detail.order_id', '=', 'order.order_id')
        //     ->select( DB::raw('COUNT(str_order.order_status) as status_count, order_status') )
        //     ->where('order_detail.vendor_id', $vendor_id)
        //     ->groupBy('order_status')
        //     ->get()->toArray();

        // return $orders;
    }

    /**
     * Count delivery status list based on orders for vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function getDeliveryStatusCountForVendor($vendor_id)
    {
        $orders = OrderCourier::select( DB::raw('COUNT(str_order_courier.status_id) as status_count, status_id') )
            ->where('order_courier.vendor_id', $vendor_id)
            ->groupBy('status_id')
            ->get()->toArray();

        $order_ids = OrderCourier::where('order_courier.vendor_id', $vendor_id)
            ->pluck('order_id')->all();

        /*$pending_ids = Order::join('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->where('order_status', 2)
            ->where('order_detail.vendor_id', $vendor_id)
            ->whereNotIn('order.order_id', $order_ids)->pluck('order.order_id')->count();*/

        $pending_ids = Order::whereHas('orderline', function ($query) use ($vendor_id) {
                                    $query->where('vendor_id', $vendor_id);
                                })
                                ->where('order_status', 2)
                                ->whereNotIn('order_id', $order_ids)
                                ->pluck('order_id')->count();
    
        if ($pending_ids > 0) {
            $pending_status = [];
            $pending_status['status_count'] = $pending_ids;
            $pending_status['status_id'] = 0;
            $orders[] = $pending_status;
        }

        return $orders;
    }

    /**
     * Count delivery status list based on orders for vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function countTotalRevenueForVendor($vendor_id)
    {
        /*return Order::with(['orderline' => function ($query) {
                            $query->select('order_id', DB::raw('ifnull(SUM(final_price),0) as total_price'));
                        }])
                        ->whereHas('orderline', function ($query) use ($vendor_id) {
                            $query->where('vendor_id', $vendor_id);
                        })
                        ->where('order_status', 2)
                        ->get();*/

        $orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->select(DB::raw('ifnull(SUM(str_order_detail.final_price),0) as total_price'))
            ->where('order_status', 2)
            ->where('order_detail.vendor_id', $vendor_id)
            ->first();

        return $orders;
    }

    /**
     * Count total orders for vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function countTotalOrderForVendor($vendor_id)
    {
        $orders = OrderDetail::where('vendor_id', $vendor_id)
            ->distinct('order_id')
            ->count('order_id');
        return $orders;
    }

    /**
     * Count total success orders for vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function countSuccessOrderForVendor($vendor_id)
    {
        return OrderDetail::where('vendor_id', $vendor_id)
                            ->whereHas('order', function ($query) {
                                $query->where('order_status', 2);
                            })
                            ->distinct('order_id')
                            ->count('order_id');

        /*$orders = OrderDetail::leftjoin('order', 'order.order_id', '=', 'order_detail.order_id')
            ->where('vendor_id', $vendor_id)
            ->where('order_status', 2)
            ->distinct('order.order_id')
            ->count('order.order_id');
        return $orders;*/
    }

    /**
     * Get List of Last 5 Transactions for login institution
     *
     * @param int $institution_id
     * @return array $orders
     */
    public function getLastTransactionSummaryForInstitution($institution_id)
    {

        return OrderDetail::with(['order' => function ($query) {
                            $query->select('order_id', 'institution_id','order_number', 'transaction_id', 'order_date', 'order_status');
                        }, 'order.ordercourier' => function ($query) {
                            $query->select('courier_id', 'status_id', 'order_id');
                        }, 'vendor' => function ($query) {
                                $query->select('vendor_id', 'vendor_name');
                        }])
                        ->whereHas('order', function ($query) use ($institution_id) {
                            $query->where('institution_id', $institution_id);
                        })
                        ->select(['order_id', 'vendor_id',DB::raw('SUM(final_price) as order_total_price')])
                        ->groupBy('order_id', 'vendor_id')
                        ->orderBy('order_id', 'DESC')
                        ->take(5)
                        ->get();

        /*$orders = OrderDetail::leftjoin('order', 'order.order_id', '=', 'order_detail.order_id')
            ->leftjoin('institution', 'institution.institution_id', '=', 'order.institution_id')
            ->leftjoin('order_courier', 'order_courier.order_id', '=', 'order.order_id')
            ->leftjoin('courier', 'courier.courier_id', '=', 'order_courier.courier_id')
            ->leftjoin('vendor', 'vendor.vendor_id', '=', 'order_detail.vendor_id');

        $orders = $orders->selectRaw('str_order.order_id, str_order.order_number, str_order.transaction_id, str_order.order_date, str_order_courier.status_id, vendor_name, order_status, (SELECT SUM(a.order_total_price) FROM str_order a WHERE a.order_id=str_order_detail.order_id and a.institution_id = '.$institution_id.') AS order_total_price');
        
        $orders = $orders->where('order.institution_id', $institution_id);

        $orders = $orders->distinct('order.order_id')
                ->orderBy('order.order_id', 'DESC')
                ->take(5)
                ->get();

        return $orders;*/
    }

    /**
     * Get List of top 5 institutions based on orders for institution login
     *
     * @param int $institution_id
     * @return array $vendors
     */
    public function getTopVendorsForInstitution($institution_id)
    {
        $vendors = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->join('vendor', 'vendor.vendor_id', '=', 'order_detail.vendor_id')
            ->where('order.institution_id', $institution_id)
            ->where('order_status', 2);

        $vendors = $vendors->select('vendor.vendor_name', DB::raw('COUNT(distinct(str_order.order_id)) as total_order, SUM(str_order_detail.final_price) as total_price'))
            ->groupBy('vendor.vendor_name')
            ->orderBy('total_order', 'DESC')
            ->orderBy('total_price', 'DESC')
            ->take(5)
            ->get();

        return $vendors;
    }

    /**
     * Count payment status list based on orders for institution
     *
     * @param int $institution_id
     * @return array $orders
     */
    public function getPaymentStatusCountForInstitution($institution_id)
    {
        $orders = Order::select( DB::raw('COUNT(str_order.order_status) as status_count, order_status') )
            ->where('order.institution_id', $institution_id)
            ->groupBy('order_status')
            ->get()->toArray();

        return $orders;
    }

    /**
     * Count delivery status list based on orders for institution
     *
     * @param int $institution_id
     * @return array $orders
     */
    public function getDeliveryStatusCountForInstitution($institution_id)
    {
        $orders = OrderCourier::whereHas('order', function ($query) use ($institution_id) {
                                    $query->where('institution_id', $institution_id);
                                })
                                ->select( DB::raw('COUNT(status_id) as status_count, status_id') )
                                ->groupBy('status_id')
                                ->get()->toArray();

        /*$orders = OrderCourier::leftjoin('order', 'order.order_id', '=', 'order_courier.order_id')
            ->select( DB::raw('COUNT(str_order_courier.status_id) as status_count, status_id') )
            ->where('order.institution_id', $institution_id)
            ->groupBy('status_id')
            ->get()->toArray();*/

        $order_ids = OrderCourier::whereHas('order', function ($query) use ($institution_id) {
                                        $query->where('institution_id', $institution_id);
                                    })->pluck('order_id')->all();

        /*$order_ids = OrderCourier::leftjoin('order', 'order.order_id', '=', 'order_courier.order_id')
            ->where('order.institution_id', $institution_id)
            ->pluck('order.order_id')->all();*/

        $pending_ids = Order::where('order_status', 2)
            ->where('order.institution_id', $institution_id)
            ->whereNotIn('order.order_id', $order_ids)->pluck('order.order_id')->count();
    
        if ($pending_ids > 0) {
            $pending_status = [];
            $pending_status['status_count'] = $pending_ids;
            $pending_status['status_id'] = 0;
            $orders[] = $pending_status;
        }

        return $orders;
    }

    /**
     * Count delivery status list based on orders for institution
     *
     * @param int $institution_id
     * @return array $orders
     */
    public function countTotalRevenueForInstitution($institution_id)
    {
        $orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->select(DB::raw('ifnull(SUM(str_order_detail.final_price),0) as total_price'))
            ->where('order_status', 2)
            ->where('order.institution_id', $institution_id)
            ->first();

        return $orders;
    }

    /**
     * Count total orders for institution
     *
     * @param int $institution_id
     * @return int $orders
     */
    public function countTotalOrderForInstitution($institution_id)
    {
        $orders = Order::where('institution_id', $institution_id)
            ->count('institution_id');
        return $orders;
    }

    /**
     * Count total success orders for institution
     *
     * @param int $institution_id
     * @return int $orders
     */
    public function countSuccessOrderForInstitution($institution_id)
    {
        $orders = Order::where('institution_id', $institution_id)
            ->where('order_status', 2)
            ->count('institution_id');
        return $orders;
    }
 
    /**
     * Get date wise total price by ajax
     *
     * @return array $data
     */
    public function getTransactionByAjax()
    {
        $data['total'] = '';
        $data['date'] = '';
        try {
            $orders = Order::select(DB::raw("SUM(order_total_price) as total_count, DATE_FORMAT(order_date, '%d-%m-%Y') as sale_date"))
                ->where('order_status', 2)
                ->groupBy('sale_date')
                ->orderBy('order_date')
                ->get()->toArray();

            $total = array_column($orders, 'total_count');
            $date = array_column($orders, 'sale_date');
            $data['total'] = $total;
            $data['date'] = $date; 
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Get date wise total price by ajax.',['OrderRepository/getTransactionByAjax', $e->getMessage()]);
            return false;
        }

        /*echo "<pre>";
        print_r($data);
        die;*/
        return $data;
    }
}