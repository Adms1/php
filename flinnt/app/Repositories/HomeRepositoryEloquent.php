<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HomeRepository;
use App\Validators\HomeValidator;
use App\Entities\User;
use App\Entities\Home;
use App\Entities\Order;
use \Cart as Cart;
use Session;
use Auth;
use Log;
use DB;

/**
 * Class HomeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HomeRepositoryEloquent extends BaseRepository implements HomeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Home::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Get static format list
     */
    public function getFormatList()
    {
        return array(
            'paperback' => 'Paperback',
            'kindal' => 'Kindal eBooks',
            'hardcover' => 'Hardcover',
            'boardbook' => 'Board Book',
        );
    }

    /**
     * Get static courier status list
     */
    public function getCourierStatusList()
    {
        return array(
            '1' => 'Processed',
            '2' => 'Delivered',
        );
    }

    /**
     * Get static courier status list
     */
    public function getPaymentStatusList()
    {
        return array(
            '1' => 'Pending',
            '2' => 'Success',
            '3' => 'Fail'
        );
    }

    /**
     * Create price filter option form
     */
    public function getPriceList()
    {
        $pr_array[0]['min'] = '0';
        $pr_array[0]['max'] = '100';
        $pr_array[1]['min'] = '100';
        $pr_array[1]['max'] = '200';
        $pr_array[2]['min'] = '200';
        $pr_array[2]['max'] = '500';
        $pr_array[3]['min'] = '500';
        $pr_array[3]['max'] = '1000';
        $pr_array[4]['min'] = '1000';
        $pr_array[4]['max'] = 'all';
        return $pr_array;
    }

    /**
     * Get product's formats list based on product ids
     *
     * @param array $products
     * @return array $formats
     */
    public function getFormatListByProductId($products)
    {
        $formats = array();
        // Get unique format keys
        $format_keys = array_unique($products->pluck('format')->toArray());

        // Get static format list
        $format_array = $this->getFormatList();
        foreach ($format_keys as $key => $format_key) {
            if (!empty($format_key))
            $formats[$format_key] = $format_array[$format_key];
        }
        return $formats;
    }

    /**
     * Get product's sell price list based on product ids
     *
     * @param array $products
     * @return array $prices
     */
    public function getSellPriceListByProductId($products)
    {
        $prices = array();
        // Get unique sell price
        $sale_prices = array_unique($products->pluck('sale_price')->toArray());
        
        // Get sell price list
        $pr_array = $this->getPriceList();
        foreach ($pr_array as $key => $price) {
            $min = $price['min'];
            $max = $price['max'];
            $newNumbers = array_filter($sale_prices, function ($value) use($min,$max) {
                return ($value >= $min && $value <= $max);
            });

            if (isset($newNumbers) && !empty($newNumbers)) {
                $prices[$key]['min'] = $price['min'];
                $prices[$key]['max'] = $price['max'];
            }
        }
        return $prices;
    }

    /**
     * Get language list based on filter's languages
     *
     * @param array $language_data
     * @return array $filter_language
     */
    public function getFilteredLanguage($language_data)
    {
        if (count($language_data) == 1) {
            $filter_language = $language_data->first();
        } elseif (count($language_data) == 2) {
            $filter_language = $language_data[0].' Or ' .$language_data[1];
        } else {
            $filter_language = 'Languages: '.count($language_data).' Selected';
        }
        return $filter_language;
    }
    
    /**
     * Get format list based on filter's formates
     *
     * @param array $selected_frmt
     * @return array $filter_format
     */
    public function getFilteredFormat($selected_frmt)
    {
        foreach ($selected_frmt as $key => $format_key) {
            // Get static format list
            $format_array = $this->getFormatList();

            if (!empty($format_key))
            $format_data[] = $format_array[$format_key];
        }

        if (count($format_data) == 1) {
            $filter_format = $format_data[0];
        } elseif (count($format_data) == 2) {
            $filter_format = $format_data[0].' Or ' .$format_data[1];
        } else {
            $filter_format = 'Formates: '.count($format_data).' Selected';
        }
        return $filter_format;
    }

    /**
     * Get author list based on filter's authors
     *
     * @param array $author_data
     * @return array $filter_author
     */
    public function getFilteredAuthors($author_data)
    {
        if (count($author_data) == 1) {
            $filter_author = $author_data->first();
        } elseif (count($author_data) == 2) {
            $filter_author = $author_data[0].' Or ' .$author_data[1];
        } else {
            $filter_author = 'Authors: '.count($author_data).' Selected';
        }
        return $filter_author;
    }

    /**
     * Get List of users by current login user
     *
     * @param int $user_id
     * @return array $orders
     */
    public function getUserOrderList($user_id)
    {
        return Order::with(['useraddress' => function ($query) {
                            $query->select('user_address_id', 'fullname');
                        }, 'ordercourier' => function ($query) {
                            $query->select('order_courier_id', 'courier_id', 'order_id', 'docket_number');
                        }, 'ordercourier.courier' => function ($query) {
                            $query->select('courier_id', 'tracking_url');
                        }])
                        ->select('order_id', 'user_id', 'shipping_address_id', 'order_number', 'transaction_id', 'payment_id', 'order_status', 'order_date', 'order_total_price')
                        ->where('user_id', $user_id)
                        ->orderBy('order_id', 'ASC')
                        ->get();

        /*return Order::join('user_address', 'user_address.user_address_id', '=', 'order.shipping_address_id')
            ->leftjoin('order_courier', 'order_courier.order_id', '=', 'order.order_id')
            ->leftjoin('courier', 'courier.courier_id', '=', 'order_courier.courier_id')
            ->where('order.user_id', $user_id)
            ->select('order.order_number', 'order.transaction_id', 'order.payment_id', 'order.order_status', 'user_address.fullname','order.order_date', 'order_total_price', 'courier_name', 'tracking_url', 'docket_number', 'order.order_id')
            ->orderBy('order.order_id', 'ASC')->get();*/
    }
 
    /**
     * Check user validation and insert it in database and do login.
     *
     * @param int $user_id
     * @return array $user
     */
    public function doUserLogin($user_id)
    {
        $exist = $this->checkUserIsExist($user_id);
        return $filter_author;
    }

    /**
     * Check user exist
     *
     * @param int $user_id
     * @return array $user
     */
    public function checkUserIsExist($user_id)
    {
        $user_data = User::firstOrCreate(['user_id' => $user_id]);
        if ($user_data) {
            $this->userLogout();
            Auth::guard('user')->loginUsingId($user_id);

            if (Auth::guard('user')->check()) {
                $user_id = Auth::guard('user')->user()->user_id;
                Log::channel('loginfo')->info('user login successfully.',['HomeRepository/checkUserIsExist']);
            }
            
            Cart::instance('cartlist')->restore($user_id.'_cart');
            Cart::instance('cartlist')->store($user_id.'_cart');
            Cart::instance('cartlist')->content();
        }
        return $user_data;
    }

    /**
     * Logout logged in user
     *
     * @return boolean
     */
    public function userLogout()
    {
        Auth::guard('user')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('vendor')->logout();
        Auth::guard('institution')->logout();
        Session::flush();
        session()->regenerate();
        Log::channel('loginfo')->info('Logout logged in user.',['HomeRepository/userLogout']);
        return true;
    }

    /**
     * Update profile info of logged-in user.
     *
     * @param array $data
     * @return array $user
     */
    public function updateProfile($data)
    {
        try {
            // Get logged in user info
            $user_id = Auth::guard('user')->user()->user_id;

            // Update user profile
            $user = User::find($user_id);
            $user->fill($data);
            $user->save();
            return $user;

        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->info('Update profile info of logged-in user.',['HomeRepository/updateProfile']);
            return false;
        }
    }
}
