<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CourierRepository;
use App\Validators\CourierValidator;
use App\Entities\OrderCourier;
//use App\Entities\OrderDetail;
use App\Entities\Courier;
use App\Entities\Order;
use Carbon\Carbon;
use Log;
//use DB;


/**
 * Class CourierRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CourierRepositoryEloquent extends BaseRepository implements CourierRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Courier::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return CourierValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
 
    /**
     * Get List of orders by current login vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function getOrderListByVendor($vendor_id = '')
    {
        return Order::with(['orderline'  => function ($query) {
                            $query->select('order_id', 'vendor_id');
                        }, 'institution' => function ($query) {
                            $query->select('institution_id','institution_name');
                        }, 'orderline.vendor' => function ($query) {
                            $query->select('vendor_id','vendor_name');
                        }, 'useraddress' => function ($query) {
                            $query->select('user_address_id','fullname');
                        }, 'ordercourier' => function ($query) {
                            $query->select('order_courier_id','order_id','status_id','courier_id','send_at','deliver_at','docket_number');
                        }, 'ordercourier.courier' => function ($query) {
                            $query->select('courier_id','courier_name','tracking_url');
                        }])
                        ->whereHas('orderline', function ($query) use ($vendor_id) {
                            if ($vendor_id) {
                                $query = $query->where('vendor_id', $vendor_id);
                            }
                        })
                        ->where('order.order_status', '2')
                        ->select(['order_id', 'institution_id', 'shipping_address_id', 'user_id', 'order_status', 'order_number'])
                        ->distinct('order.order_id')
                        ->orderBy('order.order_id', 'ASC')
                        ->get();

        // $orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
        //     ->leftjoin('institution', 'institution.institution_id', '=', 'order.institution_id')
        //     ->leftjoin('vendor', 'vendor.vendor_id', '=', 'order_detail.vendor_id')
        //     ->leftjoin('user_address', 'user_address.user_address_id', '=', 'order.shipping_address_id')
        //     ->leftjoin('order_courier', 'order_courier.order_id', '=', 'order.order_id')
        //     ->leftjoin('courier', 'courier.courier_id', '=', 'order_courier.courier_id');

        // if ($vendor_id) {
        //     $orders = $orders->where('order_detail.vendor_id', $vendor_id);
        // }

        // $orders = $orders->select('order.order_id','order.order_number', 'user_address.fullname', 'order_courier.status_id', 'send_at', 'deliver_at', 'institution_name', 'courier_name', 'docket_number', 'tracking_url', 'institution_name', 'vendor_name')
        //     ->where('order.order_status', '2')
        //     ->distinct('order.order_id')
        //     ->orderBy('order.order_id', 'ASC')->get()->toArray();

        // return $orders;
    }

    /**
     * Add/Update shipping related info by order_id
     *
     * @param array $data
     * @return array $courier
     */
    public function updateShippingInfo($data)
    {
        try {
            // Get order info by order id
            $orders = $this->getOrderInfoByOrderId($data['order_id']);
            $data['user_id'] = $orders['user_id'];
            $data['vendor_id'] = $orders['vendor_id'];
            if ($data['status_id'] == 2) {
                $data['deliver_at'] = Carbon::now();
            } else {
                $data['send_at'] = Carbon::now();    
            }
            // Add/Update courier or shipping info of order
            $order_courier = OrderCourier::firstOrNew(['order_id' => $data['order_id']]);
            if ($order_courier) {
                $order_courier->fill($data);
                $order_courier->save();
            }
            return $order_courier;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Add/Update shipping related info by order_id.',['CourierRepository/updateShippingInfo', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get order info by order_id
     *
     * @param array $order_id
     * @return array $orders
     */
    public function getOrderInfoByOrderId($order_id)
    {
        return Order::with('orderline')->where('order.order_id', $order_id)->first();

        /*return Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
                        ->where('order.order_id', $order_id)->first();*/
    }

    /**
     * Get courier info by order_id
     *
     * @param array $order_id
     * @return array $courier
     */
    public function getCourierInfoByOrderId($order_id)
    {
        return OrderCourier::where('order_courier.order_id', $order_id)->first();
    }
}

