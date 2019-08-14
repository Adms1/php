<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ReportRepository;
use App\Validators\ReportValidator;
use App\Entities\InstitutionBookVendorPrice;
use App\Entities\BookImage;
use App\Entities\Order;
use App\Entities\Report;
use Config;
use Auth;
use Log;
use DB;

/**
 * Class ReportRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ReportRepositoryEloquent extends BaseRepository implements ReportRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Report::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return ReportValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get List of products by current login user
     *
     * @param int $vendor_id
     * @return array $books
     */
    public function getBookListByLoginUser($vendor_id)
    {
        if (Auth::guard('vendor')->check()) {
            $vendor_id = Auth::guard('vendor')->user()->vendor_id;
        }

        /*$products = InstitutionBookVendorPrice::with(['book' => function ($query) {
            $query->select('book_id', 'subject_id', 'language_id', 'book_name', 'isbn','is_academic');
        }, 'vendor' => function ($query) {
            $query->select('vendor_id', 'vendor_name')
                ->orderBy('vendor.vendor_name', 'ASC');
        }, 'book.board' => function ($query) {
            $query->select('book_id','board.board_id', 'board_name');
        }, 'book.standard' => function ($query) {
            $query->select('book_id','standard.standard_id', 'standard_name');
        }, 'book.subject' => function ($query) {
            $query->select('subject_id', 'subject_name');
        }])
        ->whereHas('book', function ($query) {
            $query = $query->where('is_academic', Config::get('settings.ACADEMIC_YES'));
        })
        ->select('institution_id', 'book_id', 'vendor_id', 'institution_book_vendor_id', 'list_price', 'sale_price')
        ->get();

        foreach ($products as $key => $product) {
            $product->book_image_path = $this->getProductPrimaryImage($product->book_id);
        }

        return $products->toArray();*/

        $products = InstitutionBookVendorPrice::leftjoin('book', 'book.book_id', '=', 'institution_book_vendor_price.book_id')
            ->leftjoin('vendor', 'vendor.vendor_id', '=', 'institution_book_vendor_price.vendor_id')
            ->leftjoin('book_standard', 'book_standard.book_id', '=', 'book.book_id')
            ->leftjoin('book_board', 'book_board.book_id', '=', 'book.book_id')
            ->leftjoin('standard', 'standard.standard_id', '=', 'book_standard.standard_id')
            ->leftjoin('board', 'board.board_id', '=', 'book_board.board_id')
            ->leftjoin('subject', 'subject.subject_id', '=', 'book.subject_id');

        $products = $products->select('institution_book_vendor_id', 'book.book_id', 'vendor.vendor_id', 'list_price', 'sale_price', 'language_id', 'book.subject_id', 'book_name', 'format', 'book_standard_id', 'standard.standard_id', 'standard_name', 'vendor_name', 'board_name', 'subject_name', 'isbn');

        if ($vendor_id) {
            $products = $products->where('vendor.vendor_id', $vendor_id);
        }

        $products = $products->where('book.is_academic', Config::get('settings.ACADEMIC_YES'))
                ->orderBy('vendor.vendor_name', 'ASC')
                ->get();

        foreach ($products as $key => $product) {
            $product->book_image_path = $this->getProductPrimaryImage($product->book_id);
        }

        return $products;
    }

    /**
     * Get product's primary image name
     *
     * @param int $book_id
     * @return array $books
     */
    public function getProductPrimaryImage($book_id)
    {
        $primary_image = BookImage::where(['book_id' => $book_id, 'is_primary' => Config::get('settings.PRIMARY_IMAGE_YES')])->first();
        if (empty($primary_image)) {
            return Config::get('settings.PRODUCT_DEFAULT_IMAGE');
        }
        return $primary_image['book_image_path'];
    }

    /**
     * Get List of orders by current login admin
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function getOrderList($vendor_id)
    {
        $orders = Order::with(['orderline' => function ($query) {
                                $query->select('order_id', 'vendor_id');
                            }, 'useraddress' => function ($query) {
                                $query->select('user_address_id', 'fullname');
                            }, 'institution' => function ($query) {
                                $query->select('institution_id', 'institution_name');
                            }, 'orderline.vendor' => function ($query) {
                                $query->select('vendor_id', 'vendor_name');
                            }]);

        if (Auth::guard('institution')->check()) {
            $institution_id = Auth::guard('institution')->user()->institution_id;
            $orders = $orders->where('order.institution_id', $institution_id);
        }

        $orders = $orders->select(['order_id', 'institution_id', 'shipping_address_id', 'transaction_id', 'payment_id', 'order_number', 'order_status', 'order_total_price'])
            ->orderBy('order.order_id', 'ASC')->get();

        return $orders;

        // $orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
        //     ->leftjoin('user_address', 'user_address.user_address_id', '=', 'order.shipping_address_id')
        //     ->join('institution', 'institution.institution_id', '=', 'order.institution_id')
        //     ->join('vendor', 'vendor.vendor_id', '=', 'order_detail.vendor_id');

        // if (Auth::guard('institution')->check()) {
        //     $institution_id = Auth::guard('institution')->user()->institution_id;
        //     $orders = $orders->where('order.institution_id', $institution_id);
        // }

        // $orders = $orders->distinct('order.order_id')->orderBy('order.order_id', 'ASC')->get()->unique();

        // return $orders;
    }

    /**
     * Get List of orders by current login vendor
     *
     * @param int $vendor_id
     * @return array $orders
     */
    public function getOrderListByVendor($vendor_id)
    {
        try {
            return Order::with(['orderline' => function ($query) {
                                $query->select('order_detail_id', 'order_id', DB::raw('SUM(final_price) as order_total_price'));
                                $query->groupBy('order_id');
                            }, 'institution' => function ($query) {
                                $query->select('institution_id', 'institution_name');
                            }, 'useraddress' => function ($query) {
                                $query->select('user_address_id', 'fullname');
                            }])
                            ->whereHas('orderline', function ($query) use ($vendor_id) {
                                if ($vendor_id) {
                                    $query->where('vendor_id', $vendor_id);
                                }
                            })
                            ->select(['order_id','institution_id','shipping_address_id','order_number', 'transaction_id', 'payment_id', 'order_status', 'order_date', 'order_total_price'])
                            ->orderBy('order.order_id', 'ASC')
                            ->get();


            // $orders = Order::leftjoin('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            //     ->leftjoin('institution', 'institution.institution_id', '=', 'order.institution_id')
            //     ->leftjoin('user_address', 'user_address.user_address_id', '=', 'order.shipping_address_id');

            // if ($vendor_id) {
            //     $orders = $orders->where('order_detail.vendor_id', $vendor_id);
            // }

            // $orders = $orders->select('order.order_number', 'order.transaction_id', 'order.payment_id', 'user_address.fullname', 'order.order_status', 'order.order_date', 'institution_name', DB::raw('SUM(final_price) as order_total_price'))
            //     ->groupBy('order.order_id', 'order.order_number', 'order.transaction_id', 'order.payment_id', 'order.order_status', 'order.order_date', 'user_address.fullname', 'institution_name')
            //     ->orderBy('order.order_id', 'ASC')->get();

            // return $orders;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Get List of orders by current login vendor.',['ReportRepository/getOrderListByVendor', $e->getMessage()]);
            return false;
        }
    }
}
