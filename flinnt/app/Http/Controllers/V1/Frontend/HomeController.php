<?php

namespace App\Http\Controllers\V1\Frontend;

use Illuminate\Http\Request;

/*use App\Http\Requests;*/
use App\Repositories\HomeRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\BooksetRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\InstitutionRepository;
use App\Entities\InstitutionBooksetVendorPrice;
use App\Entities\Institution;
use App\Entities\Standard;
use App\Entities\Board;
use App\Entities\State;
use App\Entities\User;
use Config;
use Auth;
use Log;

class HomeController extends Controller
{
    /**
     * @var HomeRepository
     */
    protected $homeRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var BooksetRepository
     */
    protected $booksetRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * @var InstitutionRepository
     */
    protected $institutionRepository;

    /**
     * Create a new controller instance.
     *
     * @param HomeRepository $homeRepository
     * @param ProductRepository $productRepository
     * @param BooksetRepository $booksetRepository
     * @param CategoryRepository $categoryRepository
     * @param LanguageRepository $languageRepository
     * @param AuthorRepository $authorRepository
     * @param InstitutionRepository $institutionRepository
     * @return void
     */
    public function __construct(
        HomeRepository $homeRepository,
        ProductRepository $productRepository,
        BooksetRepository $booksetRepository,
        CategoryRepository $categoryRepository,
        LanguageRepository $languageRepository,
        AuthorRepository $authorRepository,
        InstitutionRepository $institutionRepository
    )
    {
        $this->homeRepository = $homeRepository;
        $this->productRepository = $productRepository;
        $this->booksetRepository = $booksetRepository;
        $this->categoryRepository = $categoryRepository;
        $this->languageRepository = $languageRepository;
        $this->authorRepository = $authorRepository;
        $this->institutionRepository = $institutionRepository;
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function doUserLogin(Request $request)
    {
        Log::channel('loginfo')
            ->info('user login function called.',['Frontend/HomeController/doUserLogin', 'param' =>$request->all()]);
        $data = $request->all();
        if (isset($data['id']) && is_numeric($data['id'])) {
            $user = $this->homeRepository->checkUserIsExist($data['id']);
        }

        return redirect()->route('front_home');

        // $response = [
        //     'message' => 'welcome, please update your profile before placing order.',
        //     'status' => 'warning',
        // ];
        // return redirect()->route('front_home')->with('response', $response);
    }

    /**
     * Show the application dashboard.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::channel('loginfo')
            ->info('first index page called.',['Frontend/HomeController/index', 'param' =>$request->all()]);
        $this->doUserLogin($request);

        $prices = array();
        $formats = array();
        $authors = array();
        $standards = array();
        $languages = array();
        $categories = array();
        $selected_lng = array();
        $selected_frmt = array();
        $selected_athr = array();
        $selected_min = array();
        $selected_max = array();
        $filter_data = array();
        $category_id = $request->category_id;
        $institution_id = '';
        $vendor_ids = array();

        //print_r($request->all());
        $data = $request->filter;

        // echo "--";
        // print_r($data);
        // die;
        if (!empty($data)) {
            $filter = json_decode($data);
            $selected_lng = isset($filter[0]->languages) ? $filter[0]->languages : [];
            $selected_frmt = isset($filter[0]->formats) ? $filter[0]->formats : [];
            $selected_athr = isset($filter[0]->authors) ? $filter[0]->authors : [];
            $selected_min = isset($filter[0]->min_price) ? $filter[0]->min_price : "";
            $selected_max = isset($filter[0]->max_price) ? $filter[0]->max_price : "";
        }

        // Get product based on category
        if ($category_id) {
            $parentId = $category_id;
            // Filter category list
            $categories = $this->categoryRepository->getSubcategory($parentId);
            $category_data = $this->categoryRepository->getBridgeDataById($category_id);
            //$filter_data['category_name'] = $category_data->category_name;
        } else {
            // Filter category list
            $categories = $this->categoryRepository->getSubcategory($parentId = "");
        }

        // Get selected vendors based on login user's institution
        if (Auth::guard('user')->check()) {
            $institution_id = Auth::guard('user')->user()->institution_id;
            $vendors = $this->institutionRepository->getInstitutionsListForFilter($institution_id);
            $vendor_ids = $vendors->distinct('vendor_id')->pluck('vendor_id');
        }

        $products = $this->productRepository->getFilteredProducts($category_id, $vendor_ids, $selected_lng, $selected_athr, $selected_frmt, $selected_min, $selected_max);

        // Get standards list
        $standards = $this->booksetRepository->getBooksetStandards();

        // Get product's formats list based on product ids
        $formats = $this->homeRepository->getFormatListByProductId($products);

        // Get product's sell price list based on product ids
        $prices = $this->homeRepository->getSellPriceListByProductId($products);

        // Get product's author list based on product ids
        $book_ids = array_unique($products->pluck('book_id')->toArray());
        $authors = $this->authorRepository->getAuthorsBasedOnProducts($book_ids);

        // Get product's language list based on product ids
        $language_ids = array_unique($products->pluck('language_id')->toArray());
        $languages = $this->languageRepository->getLanguagesBasedOnProducts($language_ids);

        // Get product's category_tree_id list based on product ids
        $category_tree_ids = array_unique($products->pluck('category_tree_id')->toArray());

        // Get product's institution list based on product ids
        $institutions = $this->institutionRepository->getInstitutionsListForFilter($institution_id);
        $institutions = $institutions->distinct('institution_id')->pluck('institution_name','institution.institution_id');
        

        // echo "<pre>";
        // print_r($category_tree_ids);
        // echo "---";
        // print_r($category_array);

        // foreach ($category_array as $key => $category) {
        //     if (in_array($category['category_tree_id'], $category_tree_ids)) {
        //         $categories[] = $category;
        //     }    
        // }


        // Get language list based on filter's languages
        // if ($selected_lng) {
        //     $language_data = $this->languageRepository->getLanguagesBasedOnProducts($selected_lng);
        //     $filter_data['language_name'] = $this->homeRepository->getFilteredLanguage($language_data);
        // }

        // // Get format list based on filter's formates
        // if ($selected_frmt) {
        //     $filter_data['format_name'] = $this->homeRepository->getFilteredFormat($selected_frmt);
        // }

        // // Get author list based on filter's authors
        // if ($selected_athr) {
        //     $author_data = $this->authorRepository->getAuthorsBasedOnAuthors($selected_athr);
        //     $filter_data['author_name'] = $this->homeRepository->getFilteredAuthors($author_data);
        // }
        $count = $products->count();

        // echo "<pre>";
        
        // print_r($products);
        // print_r($categories);
        // print_r($prices);
        // print_r($authors);
        // print_r($formats);
        // print_r($languages);
        // print_r($filter_data);
        
        // die;

        return view('front.welcome', compact('products', 'categories', 'standards', 'prices', 'authors', 'formats', 'languages', 'institutions', 'selected_lng', 'selected_frmt', 'selected_athr', 'selected_min', 'selected_max', 'category_id', 'institution_id', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param  int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $standard_id)
    {
        Log::channel('loginfo')->info('product display function called.',['Frontend/HomeController/show']);

        // Get book and vendor detail with price info by institution_book_vendor_price_id
        Log::channel('loginfo')->info('Get book and vendor detail with price info.',['getBookVendorPriceInfo']);
        $book_institution_book_vendor = $this->productRepository->getBookVendorPriceInfo($id);
        if (!empty($book_institution_book_vendor) || count($book_institution_book_vendor) > 0) {
            $book_id = $book_institution_book_vendor->book_id;

            // Get Product detail by product id
            Log::channel('loginfo')->info('Get Product detail by product id.',['getProductDetail']);
            $product = $this->productRepository->getProductDetail($book_id);

            // Get author details by product id
            Log::channel('loginfo')->info('Get author details by product id.',['getBookAuthor']);
            $book_authors = $this->productRepository->getBookAuthor($book_id);

            // Get product descriptions by product id
            Log::channel('loginfo')->info('Get product descriptions by product id.',['getBookDescription']);
            $book_descriptions = $this->productRepository->getBookDescription($book_id);

            // Get other vendor list who are selling same product by product id
            Log::channel('loginfo')
                ->info('Get other vendor list who are selling same product.',['getVendorListByProductId']);
            $book_vendors = $this->productRepository->getVendorListByProductId($book_institution_book_vendor['book_id'], $book_institution_book_vendor['vendor_id']);

            // Get product list related to product's grade id.
            $skip_id = $id;
            Log::channel('loginfo')->info('Get product list related to product grade id.',['getAllProducts']);
            $book_grades = $this->productRepository->getAllProducts($category_id = "", $standard_id, $skip_id);

            // Get Attributes list by product id
            Log::channel('loginfo')->info('Get Attributes list by product id.',['getAttributeList']);
            $product['attribute'] = $this->productRepository->getAttributeList($book_id);

            // Get book's primary image
            Log::channel('loginfo')->info('Get book primary image.',['getProductRelatedImages']);
            $product['images'] = $this->productRepository->getProductRelatedImages($book_id);

            return view('front.product_detail', compact('product', 'book_authors', 'book_descriptions', 'book_institution_book_vendor', 'book_vendors', 'book_grades'));
        }
    }

    /*
     * Display cart detail
     *
     * @return \Illuminate\Http\Response
     */
     
    public function cart()
    {
        return view('front.cart');
    }

    /**
     * Show product list by grade id.
     *
     * @param  Illuminate\Http\Request
     * @param  int $standard_id
     * @param  int $category_id
     * @return \Illuminate\Http\Response
     */
    public function listByGrade(Request $request, $standard_id = '', $category_id = '')
    {
        Log::channel('loginfo')->info('Show product list by grade id.',['Frontend/HomeController/listByGrade']);
        if ($category_id) {
            $parentId = $category_id;
            $products = $this->productRepository->getAllProducts($category_id, $standard_id, $skip_id = "");
            $categories = $this->categoryRepository->getSubcategory($parentId);
        } else {
            $products = $this->productRepository->getAllProducts($category_id = "", $standard_id, $skip_id = "");
            $categories = $this->categoryRepository->getSubcategory($parentId = "");
        }
        $standards = $this->booksetRepository->getBooksetStandards();
        return view('front.product_grade_list', compact('products','categories','standards'));
    }   


    /************************
    ******* Bookset *********
    ************************/


    /**
     * Show bookset list.
     *
     * @param  Illuminate\Http\Request
     * @param  int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function getBooksetList(Request $request, $standard_id = '')
    {   
        Log::channel('loginfo')->info('Show bookset list.',['Frontend/HomeController/getBooksetList']);
        // Get Bookset list by standard_id or all
        if ($standard_id) {
            $booksets = $this->booksetRepository->getAllBooksets($standard_id);
        } else {
            $booksets = $this->booksetRepository->getAllBooksets();
        }

        // Get Subcategory list by category
        Log::channel('loginfo')->info('get sub category list.',['getSubcategory']);
        $categories = $this->categoryRepository->getSubcategory($parentId = "");

        // Get all standards of bokset
        Log::channel('loginfo')->info('get all standards of bokset.',['getBooksetStandards']);
        $standards = $this->booksetRepository->getBooksetStandards();
        //$categories = $this->categoryRepository->getSubcategory($parentId);
        //$languages = $this->languageRepository->getLanguagesBasedOnProducts($products);
        return view('front.bookset_list', compact('booksets', 'categories', 'standards'));
    }

    /**
     * Display the bookset view by bookset_id
     *
     * @param  int $id
     * @param  int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function getBooksetView($id, $standard_id)
    {
        Log::channel('loginfo')
            ->info('Show bookset view by bookset_id.',['Frontend/HomeController/getBooksetView']);

        // Get bookset and vendor detail with price info by institution_book_set_vendor_id
        Log::channel('loginfo')
            ->info('Get bookset and vendor detail with price info.',['getBooksetVendorPriceInfo']);
        $book_set_vendor_price = $this->booksetRepository->getBooksetVendorPriceInfo($id);
        if (!empty($book_set_vendor_price) || count($book_set_vendor_price) > 0) {
            $book_set_id = $book_set_vendor_price['book_set_id'];
            $vendor_id = $book_set_vendor_price['vendor_id'];

            // Get Bookset detail by bookset id
            Log::channel('loginfo')->info('Get Bookset detail by bookset.');
            $bookset = $this->booksetRepository->find($book_set_id);
            //$product = $this->productRepository->getProductDetail($book_id);

            // Get bookset descriptions by bookset id
            Log::channel('loginfo')
                ->info('Get bookset descriptions by bookset.', ['getBooksetDescriptionByBooksetId']);
            $book_set_descriptions = $this->booksetRepository->getBooksetDescriptionByBooksetId($book_set_id);

            /*// Get other vendor list who are selling same bookset by bookset id
            $book_set_vendors = $this->booksetRepository->getVendorListByBooksetId($book_set_id, $vendor_id);*/

            // Get product list related to product's grade id.
            /*$skip_id = $id;
            $book_grades = $this->productRepository->getAllProducts($category_id = "", $standard_id, $skip_id);*/

            // Get bookset's primary image
            Log::channel('loginfo')->info('Get bookset primary image.', ['getBooksetRelatedImages']);
            $bookset['images'] = $this->booksetRepository->getBooksetRelatedImages($book_set_id);

            $data = ['bookset_id' => $book_set_id, 'vendor_id' => $vendor_id];

            // Get bookset list
            Log::channel('loginfo')->info('Get bookset primary image.', ['getBookListByBookData']);
            $book_list = $this->booksetRepository->getBookListByBookData($data);

            /*echo "<pre>";
            print_r($book_list);
            die;*/
            return view('front.bookset_detail', compact('bookset', 'book_set_descriptions', 'book_set_vendor_price', 'book_list'));
        }
    }

    /**
     * Show bookset list by standard id.
     *
     * @param  Illuminate\Http\Request
     * @param  int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function booksetListByGrade(Request $request, $standard_id)
    {
        Log::channel('loginfo')
            ->info('Show bookset list by standard id.',['Frontend/HomeController/booksetListByGrade']);

        if ($standard_id) {
            $booksets = $this->booksetRepository->getAllBooksets($standard_id);
        } else {
            $booksets = $this->booksetRepository->getAllBooksets();
        }

        $categories = $this->categoryRepository->getSubcategory($parentId = "");
        $standards = $this->booksetRepository->getBooksetStandards();
        return view('front.bookset_grade_list', compact('booksets','categories','standards'));
    } 

    /**
     * Display the profile view of logged-in user
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserProfile()
    {
        Log::channel('loginfo')
            ->info('Show profile view of logged-in user.',['Frontend/HomeController/getUserProfile']);
        // Get logged in user info
        $user_id = Auth::guard('user')->user()->user_id;
        $user = User::find($user_id);

        // Get Class dropdown list
        $classes = Standard::where('is_active', '1')->pluck('standard_name', 'standard_id');
        
        // Get Board dropdown list
        $boards = Board::where('is_active', '1')->pluck('board_name', 'board_id');

        // Get Institution dropdown list
        $institutions = Institution::where('is_active', '1')->pluck('institution_name', 'institution_id');

        // Get State dropdown list
        $states = State::pluck('name','state_id')->all();
        return view('front.profile', compact('user', 'classes', 'boards', 'institutions', 'states'));
    }
    
    /**
     * Update profile of logged-in user
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfileUpdate(Request $request)
    {
        Log::channel('loginfo')
            ->info('Update profile of logged-in user.',['Frontend/HomeController/userProfileUpdate']);

        $data = $request->all();
        $user = $this->homeRepository->updateProfile($data);
        if ($user) {
            $response = [
                'message' => 'Profile updated successfully.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Profile update process failed.',
                'status' => 'danger',
            ];
        }
        return redirect()->route('user_profile')->with('response', $response);
    }
 
    /**
     * Get ajax view search by product name.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getAjaxSearchProduct(Request $request)
    {
        try {
            Log::channel('loginfo')
                ->info('filtration by ajax .',['Frontend/HomeController/getAjaxSearchProduct']);
            $data = $request->all();
            $product_name = isset($data['product_name']) ? $data['product_name'] : '';
            $sort = isset($data['sorting']) ? $data['sorting'] : '';

            $authors = array();
            $standards = array();
            $languages = array();
            $categories = array();
            $selected_lng = array();
            $selected_frmt = array();
            $selected_athr = array();
            $selected_min = array();
            $selected_max = array();
            $filter_data = array();
            $category_id = $request->category_id;
            $request_data = $request->filter;
            $institution_id = $request->institution_id;
            $vendor_ids = array();

            $filter_encode_data = $request->filter_encode;

            if (!empty($filter_encode_data)) {
                $filter_data = json_decode($filter_encode_data, true);
            }
            
            if (!empty($request_data)) {
                $filter = json_decode($request_data);
                $selected_lng = isset($filter[0]->languages) ? $filter[0]->languages : [];
                $selected_frmt = isset($filter[0]->formats) ? $filter[0]->formats : [];
                $selected_athr = isset($filter[0]->authors) ? $filter[0]->authors : [];
                $selected_min = isset($filter[0]->min_price) ? $filter[0]->min_price : "";
                $selected_max = isset($filter[0]->max_price) ? $filter[0]->max_price : "";
            }

            // Get selected vendors based on login user's institution
            if (Auth::guard('user')->check()) {
                $institution_id = Auth::guard('user')->user()->institution_id;
            }

            // Get selected vendors based on institution
            if ($institution_id) {
                $vendors = $this->institutionRepository->getInstitutionsListForFilter($institution_id);
                $vendor_ids = $vendors->distinct('vendor_id')->pluck('vendor_id');
            }

            $products = $this->productRepository->getFilteredProducts($category_id, $vendor_ids, $selected_lng, $selected_athr, $selected_frmt, $selected_min, $selected_max, $product_name, $sort);

            // Get product based on category
            if ($category_id) {
                $parentId = $category_id;
                // Filter category list
                $categories = $this->categoryRepository->getSubcategory($parentId);
                $category_data = $this->categoryRepository->getBridgeDataById($category_id);
            } else {
                // Filter category list
                $categories = $this->categoryRepository->getSubcategory($parentId = "");
            }

            // Get standards list
            $standards = $this->booksetRepository->getBooksetStandards();

            // Get product's formats list based on product ids
            $formats = $this->homeRepository->getFormatListByProductId($products);

            // Get product's sell price list based on product ids
            $prices = $this->homeRepository->getSellPriceListByProductId($products);

            // Get product's author list based on product ids
            $book_ids = array_unique($products->pluck('book_id')->toArray());
            $authors = $this->authorRepository->getAuthorsBasedOnProducts($book_ids);

            // Get product's language list based on product ids
            $language_ids = array_unique($products->pluck('language_id')->toArray());
            $languages = $this->languageRepository->getLanguagesBasedOnProducts($language_ids);

            // Get product's institution list based on product ids
            $institution_data = $this->institutionRepository->getInstitutionsListForFilter($institution_id);
            $institutions = $institution_data->distinct('institution_id')->pluck('institution_name','institution.institution_id');
            $institution_name = $institution_data->distinct('institution_id')->select('institution_name')->first();

            // Get language list based on filter's languages
            if ($selected_lng) {
                $language_data = $this->languageRepository->getLanguagesBasedOnProducts($selected_lng);
                $language_name = $this->homeRepository->getFilteredLanguage($language_data);
            }

            // Get format list based on filter's formates
            if ($selected_frmt) {
                $format_name = $this->homeRepository->getFilteredFormat($selected_frmt);
            }

            // Get author list based on filter's authors
            if ($selected_athr) {
                $author_data = $this->authorRepository->getAuthorsByAuthorIds($selected_athr);
                $author_name = $this->homeRepository->getFilteredAuthors($author_data);
            }

            if (empty($filter_data)) {
                if (!empty($category_id)) {
                    $fldt['type'] = 'category';
                    $fldt['value'] = $category_data->category_name;
                    $filter_data[] = $fldt;
                }
                if (!empty($institution_id)) {
                    $fldt['type'] = 'institution';
                    $fldt['value'] = $institution_name->institution_name;
                    $filter_data[] = $fldt;
                }
                if (!empty($language_name)) {
                    $fldt['type'] = 'language';
                    $fldt['value'] = $language_name;
                    $filter_data[] = $fldt;
                }
                if (!empty($format_name)) {
                    $fldt['type'] = 'format';
                    $fldt['value'] = $format_name;
                    $filter_data[] = $fldt;
                }
                if (!empty($author_name)) {
                    $fldt['type'] = 'author';
                    $fldt['value'] = $author_name;
                    $filter_data[] = $fldt;
                }
                if (!empty($selected_min) || !empty($selected_max)) {
                    $fldt['type'] = 'price';

                    $minp = !empty($selected_min) ? $selected_min : 'min';
                    $maxp = !empty($selected_max) ? $selected_max : 'max';

                    $fldt['value'] = $minp .' - '. $maxp ;
                    $filter_data[] = $fldt;
                }
                if (!empty($product_name)) {
                    $fldt['type'] = 'search';
                    $fldt['value'] = $product_name;
                    $filter_data[] = $fldt;
                } 
            } else {
                $types = array_column($filter_data, 'type');

                if (!empty($category_id)) {
                    $found_key = array_search('category', $types);
                    if (is_int($found_key)) {
                        $filter_data[$found_key]['value'] = $category_data->category_name;
                    } else {
                        $fldt['type'] = 'category';
                        $fldt['value'] = $category_data->category_name;
                        $filter_data[] = $fldt;
                    }
                } else {
                    $found_key = array_search('category', $types);
                    if (is_int($found_key)) {
                        unset($filter_data[$found_key]);
                    }
                }

                if (!empty($institution_id)) {
                    $found_key = array_search('institution', $types);
                    if (is_int($found_key)) {
                        $filter_data[$found_key]['value'] = $institution_name->institution_name;
                    } else {
                        $fldt['type'] = 'institution';
                        $fldt['value'] = $institution_name->institution_name;
                        $filter_data[] = $fldt;
                    }
                } else {
                    $found_key = array_search('institution', $types);
                    if (is_int($found_key)) {
                        unset($filter_data[$found_key]);
                    }
                }

                if (!empty($language_name)) {
                    $found_key = array_search('language', $types);
                    if (is_int($found_key)) {
                        $filter_data[$found_key]['value'] = $language_name;
                    } else {
                        $fldt['type'] = 'language';
                        $fldt['value'] = $language_name;
                        $filter_data[] = $fldt;
                    }
                } else {
                    $found_key = array_search('language', $types);
                    if (is_int($found_key)) {
                        unset($filter_data[$found_key]);
                    }
                }
                
                if (!empty($format_name)) {
                    $found_key = array_search('format', $types);
                    if (is_int($found_key)) {
                        $filter_data[$found_key]['value'] = $format_name;
                    } else {
                        $fldt['type'] = 'format';
                        $fldt['value'] = $format_name;
                        $filter_data[] = $fldt;
                    }
                } else {
                    $found_key = array_search('format', $types);
                    if (is_int($found_key)) {
                        unset($filter_data[$found_key]);
                    }
                }

                if (!empty($author_name)) {
                    $found_key = array_search('author', $types);
                    if (is_int($found_key)) {
                        $filter_data[$found_key]['value'] = $author_name;
                    } else {
                        $fldt['type'] = 'author';
                        $fldt['value'] = $author_name;
                        $filter_data[] = $fldt;
                    }
                } else {
                    $found_key = array_search('author', $types);
                    if (is_int($found_key)) {
                        unset($filter_data[$found_key]);
                    }
                }

                if (!empty($selected_min) || !empty($selected_max)) {
                    $found_key = array_search('price', $types);
                    if (is_int($found_key)) {
                        $minp = !empty($selected_min) ? $selected_min : 'min';
                        $maxp = !empty($selected_max) ? $selected_max : 'max';

                        $filter_data[$found_key]['value'] = $minp .' - '. $maxp;
                    } else {
                        $minp = !empty($selected_min) ? $selected_min : 'min';
                        $maxp = !empty($selected_max) ? $selected_max : 'max';

                        $fldt['type'] = 'price';
                        $fldt['value'] = $minp .' - '. $maxp ;
                        $filter_data[] = $fldt;
                    }
                } else {
                    $found_key = array_search('price', $types);
                    if (is_int($found_key)) {
                        unset($filter_data[$found_key]);
                    }
                }

                if (!empty($product_name)) {
                    $found_key = array_search('search', $types);
                    if (is_int($found_key)) {
                        $filter_data[$found_key]['value'] = $product_name;
                    } else {
                        $fldt['type'] = 'search';
                        $fldt['value'] = $product_name;
                        $filter_data[] = $fldt;
                    }
                } else {
                    $found_key = array_search('search', $types);
                    if (is_int($found_key)) {
                        unset($filter_data[$found_key]);
                    }
                }
            }

            $filter_data = array_values($filter_data);
            if (!empty($filter_data)) {
                $string = '';
                foreach ($filter_data as $key => $filter) {
                    $string .= ' : '.$filter['value'];
                }
            }

            $filter_encode = json_encode($filter_data);

            $count = $products->count();

            $filter_product = view('front.partials.filter.filter_product', compact('products'))->render();
            $filter_option = view('front.partials.filter.filter_option', compact('categories', 'standards', 'prices', 'authors', 'formats', 'languages', 'institutions', 'selected_lng', 'selected_frmt', 'selected_athr', 'selected_min', 'selected_max', 'category_id', 'institution_id'))->render();
            $filter_header = view('front.partials.filter.filter_header', compact('count', 'filter_encode','string'))->render();
            return response()->json([
                'filter_product' => $filter_product,
                'filter_option' => $filter_option,
                'filter_header' => $filter_header
            ]);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Log::channel('loginfo')->error('filtration view by ajax.',[$e->getMessageBag()]);
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the order list view of logged-in user
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserOrderList()
    {
        Log::channel('loginfo')
            ->info('the order list view of logged-in user.',['Frontend/HomeController/getUserOrderList']);
        // Get logged in user info
        $user_id = Auth::guard('user')->user()->user_id;
        $user = User::find($user_id);

        // Get order list
        Log::channel('loginfo')->info('Get order list.',['getUserOrderList']);
        $orders = $this->homeRepository->getUserOrderList($user_id);
        return view('front.order_list', compact('user', 'orders'));
    }

    /**
     * process to do user logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function doUserLogout()
    {
        // Get Class dropdown list
        Log::channel('loginfo')->info('user logout function.',['Frontend/HomeController/doUserLogout']);
        $orders = $this->homeRepository->userLogout();
        return redirect()->route('front_home');
    }
}