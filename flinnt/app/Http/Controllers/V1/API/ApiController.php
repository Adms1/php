<?php

namespace App\Http\Controllers\V1\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\BooksetRepository;
use App\Repositories\OrderRepository;
use App\Entities\ShoppingCart;
use App\Entities\Publisher;
use App\Entities\UserAddress;
use App\Entities\Language;
use App\Entities\Board;
use App\Entities\State;
use App\Entities\Author;
use \Cart as Cart;
use Config;
use Auth;

class ApiController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var BooksetRepository
     */
    protected $booksetRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param LanguageRepository $languageRepository
     * @param BooksetRepository $booksetRepository
     * @param OrderRepository $orderRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        LanguageRepository $languageRepository,
        BooksetRepository $booksetRepository,
        OrderRepository $orderRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->languageRepository = $languageRepository;
        $this->booksetRepository = $booksetRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Get all book list.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getBookList(Request $request)
    {
        try {
            $data = $request->all();
            // Get product list
            $products = $this->productRepository->getAllProducts($category_id = "", $grade_id = "", $skip_id = "");
            // Set response output
            $output = [];
            if (!empty($products) && count($products) > 0) {
                $count = 0;
                $main_standard = $products[$count]->standard_id;
                $standard_name = $products[$count]->standard_name;
                $data_array['standard_id'] = $main_standard;
                $data_array['standard_name'] = $standard_name;
                Cart::instance('cartlist')->restore($request->user_id.'_cart');
                Cart::instance('cartlist')->store($request->user_id.'_cart');
                $data_array['cart_total'] = Cart::instance('cartlist')->count();
                foreach ($products as $key => $product) {
                    // Set image path
                    $product['thumbnail_path'] = url(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $product->book_image_path);
                    $product['original_path'] = url(Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH') . $product->book_image_path);
                    $product['type'] = 'book';
                    if ($main_standard == $product->standard_id) {
                        $data_array['courses'][] = $product;
                        $output[$count] = $data_array;
                    } else {
                        $data_array = [];
                        $count ++;
                        
                        $main_standard = $product->standard_id;
                        $standard_name = $product->standard_name;
                        
                        $data_array['standard_id'] = $main_standard;
                        $data_array['standard_name'] = $standard_name;
                        $data_array['courses'][] = $product;
                        $output[$count] = $data_array;
                    }
                }
            }

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'product_list_found_successfully',
                'data' => $output
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get book information by book id.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getBookDetail(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'institution_book_vendor_id' => 'required'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            $data = $request->all();
            // Get book and vendor detail with price info by institution_book_vendor_price_id
            $book_institution_book_vendor = $this->productRepository->getBookVendorPriceInfo($data['institution_book_vendor_id']);
            if (!empty($book_institution_book_vendor) || count($book_institution_book_vendor) > 0) {
                $images = [];
                $book_id = $book_institution_book_vendor->book_id;

                // Get Product detail by product id
                $product = $this->productRepository->getProductDetail($book_id);
                $product['institution_book_vendor_id'] = $book_institution_book_vendor['institution_book_vendor_id'];
                $product['vendor_name'] = $book_institution_book_vendor['vendor_name'];
                $product['email'] = $book_institution_book_vendor['email'];
                $product['list_price'] = $book_institution_book_vendor['list_price'];
                $product['sale_price'] = $book_institution_book_vendor['sale_price'];
                
                // Get author details by product id
                $product['authors'] = $this->productRepository->getBookAuthor($book_id);

                // Get product descriptions by product id
                $product['descriptions'] = $this->productRepository->getBookDescription($book_id);

                // Get attributes list by product id
                $attributes = $this->productRepository->getAttributeList($book_id);
                $extra_attr['Publisher Name'] = $product->publisher_name;
                $extra_attr['Language Name'] = $product->language_name;
                $extra_attr['HS Code'] = $product->hs_code;
                $extra_attr['ISBN'] = $product->isbn;
                $extra_attr['Series'] = $product->series;
                $extra_attr['Format'] = $product->format;
                foreach ($attributes as $key => $attribute) {
                    $extra_attr[$attribute['attribute_name']] = $attribute['attribute_value'];
                }
                $product['attribute'] = $extra_attr;

                // Get book's images
                $images = $this->productRepository->getProductRelatedImages($book_id);
                if (count($images) > 0) {
                    foreach ($images as $key => $image) {
                        $image['thumbnail_path'] = url(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $image->book_image_path);
                        $image['original_path'] = url(Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH') . $image->book_image_path);
                    }
                } else {
                    $image['thumbnail_path'] = url(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . Config::get('settings.PRODUCT_DEFAULT_IMAGE'));
                    $image['original_path'] = url(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . Config::get('settings.PRODUCT_DEFAULT_IMAGE'));
                    $images[] = $image;
                }
                $product['images'] = $images;
                
                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'product_found_successfully',
                    'data' => $product
                ];
            } else {
                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'product_found_successfully',
                    'data' => ''
                ];
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Get Book list related to book's standard
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getBookListRelatedToBook(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'institution_book_vendor_id' => 'required',
                'standard_id' => 'required',
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            $data = $request->all();

            // Get book and vendor detail with price info by institution_book_vendor_price_id
            $book_institution_book_vendor = $this->productRepository->getBookVendorPriceInfo($data['institution_book_vendor_id']);
            if (!empty($book_institution_book_vendor) || count($book_institution_book_vendor) > 0) {

                // Get product list related to product's grade id.
                $skip_id = $data['institution_book_vendor_id'];
                $grade_id = $data['standard_id'];
                $products = $this->productRepository->getAllProducts($category_id = "", $grade_id, $skip_id);

                if (!empty($products) && count($products) > 0) {
                    foreach ($products as $key => $product) {
                        // Set image path
                        $product['thumbnail_path'] = url(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $product->book_image_path);
                        $product['original_path'] = url(Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH') . $product->book_image_path);
                    }
                }
                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'product_list_found_successfully',
                    'data' => $products
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'product_list_found_successfully',
                    'data' => []
                ];
                return response()->json($response, 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Get other vendor list who are selling same book by book id
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getOtherVendorListRelatedToBook(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'institution_book_vendor_id' => 'required',
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            $data = $request->all();

            // Get book and vendor detail with price info by institution_book_vendor_price_id
            $book_institution_book_vendor = $this->productRepository->getBookVendorPriceInfo($data['institution_book_vendor_id']);
            if (!empty($book_institution_book_vendor) || count($book_institution_book_vendor) > 0) {

                // Get other vendor list who are selling same product by product id
                $products = $this->productRepository->getVendorListByProductId($book_institution_book_vendor['book_id'], $book_institution_book_vendor['vendor_id']);

                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'product_list_found_successfully',
                    'data' => $products
                ];
            } else {
                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'product_list_found_successfully',
                    'data' => []
                ];
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of cart items.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getCartList(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'user_id' => 'required'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            Cart::instance('cartlist')->restore($request->user_id.'_cart');
            Cart::instance('cartlist')->store($request->user_id.'_cart');
            $carts = Cart::instance('cartlist')->content()->toArray();
            $output = [];
            if (!empty($carts) || count($carts) > 0) {
                $output['user_id'] = $request->user_id;
                foreach ($carts as $key => $cart) {
                    switch ($cart['options']['type']) {
                        case 'book':
                            $products = $this->productRepository->getBookVendorPriceInfo($cart['id']);
                            $cart['vendor_name'] = $products['vendor_name'];
                            break;

                        case 'bookset':
                            $products = $this->booksetRepository->getBooksetVendorPriceInfo($cart['id']);
                            $cart['vendor_name'] = $products['vendor_name'];
                            break;

                        default:
                            $products = $this->productRepository->getBookVendorPriceInfo($cart['id']);
                            $cart['vendor_name'] = $products['vendor_name'];
                            break;
                    }
                    $cart['thumbnail_path'] = url($cart['options']['image']);
                    $cart['type'] = $cart['options']['type'];
                    $items[] = $cart;
                }
                $output['cart_item'] = $items;

                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'cart_list_found_successfully',
                    'data' => $output
                ];
            } else {
                $response = [
                    'status' => 1,
                    'page' => 0,
                    'message' => 'cart_is_empty',
                    'data' => []
                ];
            }
            return response()->json($response, 200);            
        } catch (\Exception $e) {
            //throw $e;
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Store a newly created cart item in storage.
     *
     * @param  CartCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function cartStore(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'user_id' => 'required',
                'id' => 'required',
                'name' => 'required',
                'book_id' => 'required',
                'price' => 'required',
                'qty' => 'required',
                'type' => 'required',
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            Cart::instance('cartlist')->restore($request->user_id.'_cart');
            Cart::instance('cartlist')->store($request->user_id.'_cart');
            $duplicates = Cart::instance('cartlist')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id === $request->id;
            });

            if (!$duplicates->isEmpty()) {
                $response = [
                    'status' => 1,
                    'message' => 'item_is_already_in_your_cart',
                ];
                return response()->json($response, 200);
            }

            if ($request->book_id) {
                switch ($request->type) {
                    case 'book':
                        $path = $this->productRepository->getProductPrimaryImage($request->book_id);
                        $option['image'] = Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $path;
                        break;

                    case 'bookset':
                        $path = $this->booksetRepository->getBooksetPrimaryImage($request->book_id);
                        $option['image'] = Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH') . $path;
                        break;

                    default:
                        $path = $this->productRepository->getProductPrimaryImage($request->book_id);
                        $option['image'] = Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $path;
                        break;
                }
                $option['type'] = $request->type;
            }

            $qty = isset($request->qty) ? $request->qty : 1;

            Cart::instance('cartlist')->add($request->id, $request->name, $qty , $request->price, $option)->associate('App\Product');
            Cart::instance('cartlist')->restore($request->user_id.'_cart');
            Cart::instance('cartlist')->store($request->user_id.'_cart');
            $carts = Cart::instance('cartlist')->content();
            foreach ($carts as $key => $cart) {
                $data = $cart;
            }
            $response = [
                'status' => 1,
                'message' => 'item_is_added_to_your_cart',
                'data' => $data
            ];
            return response()->json($response, 200);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Update cart quantity.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function cartUpdate(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'user_id' => 'required',
                'rowId' => 'required',
                'qty' => 'required',
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }
            Cart::instance('cartlist')->restore($request->user_id.'_cart');
            Cart::instance('cartlist')->store($request->user_id.'_cart');
            $exist = Cart::instance('cartlist')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->rowId === $request->rowId;
            });
            if ($exist->isEmpty()) {
                 $response = [
                    'status' => 1,
                    'message' => 'item_is_not_in_your_cart',
                ];
                return response()->json($response, 200);
            }

            Cart::instance('cartlist')->restore($request->user_id.'_cart');
            Cart::instance('cartlist')->update($request->rowId, $request->qty);
            Cart::instance('cartlist')->store($request->user_id.'_cart');
            $carts = Cart::instance('cartlist')->content();
            foreach ($carts as $key => $cart) {
                $data = $cart;
            }
            $response = [
                'status' => 1,
                'message' => 'item_quantity_updated_successfully',
                'data' => $data
            ];
            return response()->json($response, 200);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * Remove the specified item from cart
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function cartDestroy(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'user_id' => 'required',
                'rowId' => 'required',
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            Cart::instance('cartlist')->restore($request->user_id.'_cart');
            Cart::instance('cartlist')->store($request->user_id.'_cart');
            $exist = Cart::instance('cartlist')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->rowId === $request->rowId;
            });
            if ($exist->isEmpty()) {
                 $response = [
                    'status' => 1,
                    'message' => 'item_is_not_in_your_cart',
                ];
                return response()->json($response, 200);
            }

            Cart::instance('cartlist')->restore($request->user_id.'_cart');
            Cart::instance('cartlist')->remove($request->rowId);
            Cart::instance('cartlist')->store($request->user_id.'_cart');
            $carts = Cart::instance('cartlist')->content();
            $response = [
                'status' => 1,
                'message' => 'item_has_been_removed_successfully',
            ];
            return response()->json($response, 200);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get all bookset list.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getBooksetList(Request $request)
    {   
        try {
            $data = $request->all();
            $booksets = $this->booksetRepository->getAllBooksets();
            /*echo "<pre>";
            print_r($booksets);
            die;*/

            // Set response output
            $output = [];
            if (!empty($booksets) && count($booksets) > 0) {
                $count = 0;
                $main_standard = $booksets[$count]->standard_id;
                $standard_name = $booksets[$count]->standard_name;
                $data_array['standard_id'] = $main_standard;
                $data_array['standard_name'] = $standard_name;
                Cart::instance('cartlist')->restore($request->user_id.'_cart');
                Cart::instance('cartlist')->store($request->user_id.'_cart');
                $data_array['cart_total'] = Cart::instance('cartlist')->count();
                foreach ($booksets as $key => $bookset) {
                    // Set image path
                    $bookset['thumbnail_path'] = url(Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH') . $bookset->book_set_image_path);
                    $bookset['original_path'] = url(Config::get('settings.ORIGINAL_BOOKSET_IMG_PATH') . $bookset->book_set_image_path);
                    $bookset['type'] = 'bookset';
                    if ($main_standard == $bookset->standard_id) {
                        $data_array['courses'][] = $bookset;
                        $output[$count] = $data_array;
                    } else {
                        $output[$count] = $data_array;
                        $data_array = [];
                        $count ++;
                        
                        $main_standard = $bookset->standard_id;
                        $standard_name = $bookset->standard_name;
                        
                        $data_array['standard_id'] = $main_standard;
                        $data_array['standard_name'] = $standard_name;
                        $data_array['courses'][] = $bookset;
                        $output[$count] = $data_array;
                    }
                }
            }

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'bookset_list_found_successfully',
                'data' => $output
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get bookset information by bookset id.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getBooksetDetail(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'institution_book_set_vendor_id' => 'required'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            $data = $request->all();
            // Get bookset and vendor detail with price info by institution_book_set_vendor_id
            $book_set_institution_book_vendor = $this->booksetRepository->getBooksetVendorPriceInfo($data['institution_book_set_vendor_id']);
            if (!empty($book_set_institution_book_vendor) || count($book_set_institution_book_vendor) > 0) {
                $images = [];
                $book_set_id = $book_set_institution_book_vendor->book_set_id;
                $vendor_id = $book_set_institution_book_vendor->vendor_id;

                // Get bookset detail by bookset id
                $product = $this->booksetRepository->find($book_set_id);

                $product['institution_book_set_vendor_id'] = $book_set_institution_book_vendor['institution_book_set_vendor_id'];
                $product['vendor_name'] = $book_set_institution_book_vendor['vendor_name'];
                $product['email'] = $book_set_institution_book_vendor['email'];
                $product['list_price'] = $book_set_institution_book_vendor['list_price'];
                $product['sale_price'] = $book_set_institution_book_vendor['sale_price'];

                // Get product descriptions by product id
                $product['descriptions'] = $this->booksetRepository->getBooksetDescriptionByBooksetId($book_set_id);

                // Get book's images
                $images = $this->booksetRepository->getBooksetRelatedImages($book_set_id);
                if (count($images) > 0) {
                    foreach ($images as $key => $image) {
                        $image['thumbnail_path'] = url(Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH') . $image->book_set_image_path);
                        $image['original_path'] = url(Config::get('settings.ORIGINAL_BOOKSET_IMG_PATH') . $image->book_set_image_path);
                    }
                }
                $product['images'] = $images;

                // Get list of books by bookset id
                $data = ['bookset_id' => $book_set_id, 'vendor_id' => $vendor_id];
                $books = $this->booksetRepository->getBookListByBookData($data);
                foreach ($books as $key => $book) {
                    $array = [];
                    $book_array[] = $book;
                }
                $product['booklist'] = $book_array;

                $response = [
                    'status' => 1,
                    'message' => 'product_found_successfully',
                    'data' => $product
                ];
            } else {
                $response = [
                    'status' => 1,
                    'message' => 'product_found_successfully',
                    'data' => ''
                ];
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Get list of states.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getStateList(Request $request)
    {   
        try {
            $states = State::pluck('name','state_id')->all();

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'state_list_found_successfully',
                'data' => $states
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Add user addresses
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function addUserAddress(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'user_id' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'state_id' => 'required'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }
            $data = $request->all();
            $data['country_id'] = 1;
            // Store user address
            $user_address = $this->orderRepository->createUserAddress($data);
            if ($user_address) {
                 $response = [
                    'status' => 1,
                    'message' => 'address_added_successfully',
                    'data' => $user_address->toArray()
                ];
                return response()->json($response, 200);
            }

            $response = [
                'status' => 0,
                'message' => 'address_store_failed',
                'data' => ''
            ];
            return response()->json($response, 200);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get list of user address.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getUserAddressList(Request $request)
    {   
        try {
            $validation = Validator::make($request->all(),[ 
                'user_id' => 'required'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            $data = $request->all();
            $user_address = $this->orderRepository->getUserAddresslist($data['user_id']);

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'user_address_list_found_successfully',
                'data' => $user_address
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Update user address
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function updateUserAddress(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'user_id' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'state_id' => 'required'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }
            $data = $request->all();
            $data['country_id'] = 1;
            // Update user address
            $id = $data['user_address_id'];
            $user_address = $this->orderRepository->updateUserAddressById($data, $id);
            if ($user_address) {
                 $response = [
                    'status' => 1,
                    'message' => 'address_updated_successfully',
                    'data' => $user_address->toArray()
                ];
                return response()->json($response, 200);
            }

            $response = [
                'status' => 0,
                'message' => 'address_update_failed',
            ];
            return response()->json($response, 200);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Remove the specified address
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function addressDestroy(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[ 
                'user_address_id' => 'required'
            ]);

            if($validation->fails()){
                return response()->json([
                    'status'   => 0,
                    'message' => $validation->errors()
                ]);
            }

            $deleted = UserAddress::destroy($request->user_address_id);
            if ($deleted) {
                $response = [
                    'status' => 1,
                    'message' => 'Address deleted successfully.',
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => 'Address delete process failed.',
                ];
            }
            return response()->json($response, 200);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get list of author.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getAuthorList(Request $request)
    {   
        try {
            $authors = Author::pluck('author_name','author_id')->all();

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'author_list_found_successfully',
                'data' => $authors
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get list of board.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getBoardList(Request $request)
    {   
        try {
            $boards = Board::pluck('board_name','board_id')->all();

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'board_list_found_successfully',
                'data' => $boards
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get list of Language.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getLanguageList(Request $request)
    {   
        try {
            $languages = Language::pluck('language_name','language_id')->all();

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'language_list_found_successfully',
                'data' => $languages
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get list of publisher.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getPublisherList(Request $request)
    {   
        try {
            $publishers = Publisher::pluck('publisher_name','publisher_id')->all();

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'publisher_list_found_successfully',
                'data' => $publishers
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get list of filters.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getFilterList(Request $request)
    {   
        try {
            $data['authors'] = Author::select('author_id', 'author_name')->get()->toArray();
            $data['boards'] = Board::select('board_id','board_name')->get()->toArray();
            $data['languages'] = Language::select('language_id','language_name')->get()->toArray();
            $data['publishers'] = Publisher::select('publisher_id','publisher_name')->get()->toArray();
            $data['format'] = array(
                'paperback' => 'Paperback',
                'kindal' => 'Kindal eBooks',
                'hardcover' => 'Hardcover',
                'boardbook' => 'Board Book');
            $data['categories'] = $this->categoryRepository->getSubcategory('0');

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'filter_list_found_successfully',
                'data' => $data
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Get filtered book list.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getFilteredBookList(Request $request)
    {
        try {
            $data = $request->all();
            $vendor_ids = array();

            if (!empty($data)) {
                $selected_lng = isset($data['language_id']) ? $data['language_id'] : [];
                $selected_frmt = isset($data['format']) ? $data['format'] : [];
                $selected_athr = isset($data['author_id']) ? $data['author_id'] : [];
                $selected_min = isset($data['min']) ? $data['min'] : "";
                $selected_max = isset($data['max']) ? $data['max'] : "";
                $category_id = isset($data['category_tree_id']) ? $data['category_tree_id'] : "";
            }

            // Get selected vendors based on login user's institution
            if (Auth::guard('user')->check()) {
                $institution_id = Auth::guard('user')->user()->institution_id;
                $vendors = $this->institutionRepository->getInstitutionsListForFilter($institution_id);
                $vendor_ids = $vendors->distinct('vendor_id')->pluck('vendor_id');
            }

            // Get product list
            $products = $this->productRepository->getFilteredProducts($category_id, $vendor_ids, $selected_lng, $selected_athr, $selected_frmt, $selected_min, $selected_max);

            // Set response output
            $output = [];
            if (!empty($products) && count($products) > 0) {
                $count = 0;
                $main_standard = $products[$count]->standard_id;
                $standard_name = $products[$count]->standard_name;
                $data_array['standard_id'] = $main_standard;
                $data_array['standard_name'] = $standard_name;
                Cart::instance('cartlist')->restore($request->user_id.'_cart');
                Cart::instance('cartlist')->store($request->user_id.'_cart');
                $data_array['cart_total'] = Cart::instance('cartlist')->count();
                foreach ($products as $key => $product) {
                    // Set image path
                    $product['thumbnail_path'] = url(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $product->book_image_path);
                    $product['original_path'] = url(Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH') . $product->book_image_path);
                    $product['type'] = 'book';
                    if ($main_standard == $product->standard_id) {
                        $data_array['courses'][] = $product;
                        $output[$count] = $data_array;
                    } else {
                        $data_array = [];
                        $count ++;
                        
                        $main_standard = $product->standard_id;
                        $standard_name = $product->standard_name;
                        
                        $data_array['standard_id'] = $main_standard;
                        $data_array['standard_name'] = $standard_name;
                        $data_array['courses'][] = $product;
                        $output[$count] = $data_array;
                    }
                }
            }

            $response = [
                'status' => 1,
                'page' => 0,
                'message' => 'product_list_found_successfully',
                'data' => $output
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }
}