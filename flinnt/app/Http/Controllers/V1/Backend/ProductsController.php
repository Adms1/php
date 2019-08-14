<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;

/*use App\Http\Requests;*/
use App\Http\Controllers\V1\Backend\BaseController;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Validators\ProductValidator;
use App\Entities\InstitutionBookVendorPrice;
use App\Entities\Attribute;
use App\Entities\Condition;
use App\Entities\Publisher;
use App\Entities\Standard;
use App\Entities\Language;
use App\Entities\Subject;
use App\Entities\Author;
use App\Entities\Board;
use Config;

/**
 * Class ProductsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class ProductsController extends Controller
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
     * @var BaseController
     */
    protected $baseController;

    /**
     * @var ProductValidator
     */
    protected $validator;

    /**
     * ProductsController constructor.
     *
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param BaseController $baseController
     * @param ProductValidator $validator
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        BaseController $baseController,
        ProductValidator $validator)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->baseController = $baseController;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->productRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        // Get list of products based on login vendor
        $products = $this->productRepository->getBookListByLoginVendor();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Display a listing of the product by searching.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function productSearch(Request $request)
    {
        $data = $request->all();
        $products = [];
        $this->productRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        if (isset($data['product_name'])) {
            $products = $this->productRepository->getSearchListByProductName($data['product_name']);
        }
        return view('admin.products.search', compact('products', 'data'));
    }

    /**
     * Display a listing of the product by searching.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function productAddOffer(Request $request, $id)
    {
        $data = $request->all();
        $this->productRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $product = $this->productRepository->find($id);
        // Get Images of product
        $image = $this->productRepository->getProductPrimaryImage($id);
        if ($image) {
            $product->image = url(Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH').$image);   
        }

        $product->publisher_name = Publisher::where('publisher_id', $product->publisher_id)->pluck('publisher_name')->first();
        
        $conditions = Condition::where('is_active', '1')->pluck('condition_name', 'condition_id');
        return view('admin.products.addoffer', compact('product', 'conditions'));
    }

    /**
     * Store the vendor offer about the product.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function productStoreOffer(Request $request, $id)
    {
        $data = $request->all();
        $this->productRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        if ($data) {
            $products = $this->productRepository->storeVendorOffer($data, $id);
        }
        $products = $this->productRepository->getBookListByLoginVendor();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get Publishers dropdown list
        $publishers = Publisher::where('is_active', '1')->pluck('publisher_name', 'publisher_id');
        $publishers->prepend('', '');
        
        // Get language dropdown list
        $languages = Language::where('is_active', '1')->pluck('language_name', 'language_id');

        // Get author dropdown list
        $authors = Author::where('is_active', '1')->pluck('author_name', 'author_id');

        // Get standard dropdown list
        $class = Standard::where('is_active', '1')->pluck('standard_name', 'standard_id');

        // Get board dropdown list
        $board = Board::where('is_active', '1')->pluck('board_name', 'board_id');

        // Get subject dropdown list
        $subject = Subject::where('is_active', '1')->pluck('subject_name', 'subject_id');

        // Get Category dropdown list
        $categories = $this->categoryRepository->getCategoryDropdownList();

        $formats = array(
            'paperback' => 'Paperback',
            'kindal' => 'Kindal eBooks',
            'hardcover' => 'Hardcover',
            'boardbook' => 'Board Book',
        );

        $sizes = array (
            '1' => 'Standard',
            '2' => '24 pack',
            '3' => 'small',
            '4' => 'A4'
        );
        
        $cover_types = array (
            '1' => 'Hard Copy',
            '2' => 'Paper Copy'
        );

        $colors = array (
            '1' => 'Black',
            '2' => 'Blue',
            '3' => 'Red',
            '4' => 'Green'
        );
        
        $styles = array (
            '1' => 'Medium'
        );

        $product_types = array(
            '1' => 'book',
            '2' => 'other'
        );

        $brands = array(
            '1' => 'Apple',
            '2' => 'Dell'
        );

        $sp_attributes = array(
            '1' => 'Screen Size',
            '2' => 'Model Name',
            '3' => 'Brand Name',
            '4' => 'Number of USB ports'
        );

        $pr_attributes = array(
            '1' => 'Color',
            '2' => 'Style',
            '3' => 'Size',
            '4' => 'Language',
        );

        $dlry_day = array(
            '1' => '1-2 days',
            '2' => '3-5 days',
            '3' => '1 week'
        );

        return view('admin.products.add',compact('publishers','cover_types','languages','categories','sizes', 'colors', 'styles', 'product_types', 'brands', 'sp_attributes', 'pr_attributes', 'dlry_day', 'authors', 'class', 'board', 'formats', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->all();
            
            //return response()->json(['success' => true]);
            //return response()->json(['status' => 'Input not found']);

            $product = $this->productRepository->createProduct($data);
            if ($product) {
                $response = [
                    'message' => 'Product successfully created.',
                    'status' => 'success',
                    'data'    => $product->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Product not created.',
                    'status' => 'danger',
                ];
            }

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('product_edit', [$product->book_id, 'tab' => 'product_images'])->with('response', $response);
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->getProductByID($id);
        return view('admin.products.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Get Publishers dropdown list
        $publishers = Publisher::where('is_active', '1')->pluck('publisher_name', 'publisher_id');

        // Get Attributes dropdown list
        $attributes = Attribute::where('is_active', '1')
                            ->where('product_type', 'book')->pluck('attribute_name', 'attribute_id');

        // Get Language dropdown list
        $languages = Language::where('is_active', '1')->pluck('language_name', 'language_id');

        // Get Author dropdown list
        $authors = Author::where('is_active', '1')->pluck('author_name', 'author_id');
        
        // Get Class dropdown list
        $class = Standard::where('is_active', '1')->pluck('standard_name', 'standard_id');
        
        // Get Board dropdown list
        $board = Board::where('is_active', '1')->pluck('board_name', 'board_id');

        // Get subject dropdown list
        $subject = Subject::where('is_active', '1')->pluck('subject_name', 'subject_id');

        // Get Category dropdown list
        $categories = $this->categoryRepository->getCategoryDropdownList();

        // Get Product info by product id
        $product = $this->productRepository->find($id);

        $formats = array(
            'paperback' => 'Paperback',
            'kindal' => 'Kindal eBooks',
            'hardcover' => 'Hardcover',
            'boardbook' => 'Board Book',
        );

        $sizes = array (
            '1' => 'Standard',
            '2' => '24 pack',
            '3' => 'small',
            '4' => 'A4'
        );

        $cover_types = array (
            '1' => 'Hard Copy',
            '2' => 'Paper Copy'
        );

        $colors = array (
            '1' => 'Black',
            '2' => 'Blue',
            '3' => 'Red',
            '4' => 'Green'
        );

        $styles = array (
            '1' => 'Medium'
        );

        $product_types = array(
            '1' => 'book',
            '2' => 'other'
        );

        $brands = array(
            '1' => 'Apple',
            '2' => 'Dell'
        );

        $pr_attributes = array(
            '1' => 'Color',
            '2' => 'Style',
            '3' => 'Size',
            '4' => 'Language',
        );

        $dlry_day = array(
            '1' => '1-2 days',
            '2' => '3-5 days',
            '3' => '1 week'
        );

        // Get author details by product id
        $book_authors = $this->productRepository->getBookAuthor($id);
        foreach ($book_authors as $key => $book_author) {
            $author_array[] = $book_author->author_id;
        }
        $product['author'] = $author_array;
        
        // Get board details by product id
        $book_boards = $this->productRepository->getBookBoard($id);
        if (count($book_boards) > 0) {
            foreach ($book_boards as $key => $book_board) {
                $board_array[] = $book_board->board_id;
            }
            $product['board'] = $board_array;
        }

        // Get standard details by product id
        $book_standards = $this->productRepository->getBookStandard($id);
        if (count($book_standards) > 0) {
            foreach ($book_standards as $key => $book_standard) {
                $standard_array[] = $book_standard->standard_id;
            }
            $product['standard'] = $standard_array;
        }
        
        // Get category details by product id
        $book_categorytrees = $this->productRepository->getBookCategoryTree($id);
        foreach ($book_categorytrees as $key => $book_categorytree) {
            $book_categorytree_array[] = $book_categorytree->category_tree_id;
        }
        $product['category_tree'] = $book_categorytree_array;
        
        // Get product details by product id
        $book_descriptions = $this->productRepository->getBookDescription($id);
        foreach ($book_descriptions as $key => $book_description) {
            $description_array[] = $book_description->description;
        }
        $product['description'] = $description_array;

        // Get vendor details by product id
        $book_institution_book_vendor = $this->productRepository->getInstitutionBookVendorPrice($id);
        if ($book_institution_book_vendor) {
            $product['list_price'] = $book_institution_book_vendor->list_price;
            $product['display_price'] = $book_institution_book_vendor->sale_price;
        }

        // Get Attributes list
        $product['attribute'] = $this->productRepository->getAttributeList($id);

        // Get book's primary image
        $product['primary_image'] = $this->productRepository->getProductPrimaryImage($id);

        // Set product type
        $product['product_type'] = 'book';

        $product['tab'] = (!empty($request->all())) ? $request->input('tab') : '';
        return view('admin.products.edit', compact('id', 'product','publishers','cover_types','languages','categories','sizes', 'colors', 'styles', 'product_types', 'brands', 'attributes', 'pr_attributes', 'dlry_day', 'authors', 'class', 'board', 'formats', 'subject', 'tab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $data = $request->all();

            // Uplaod primary image
            $image_info = $this->baseController->imageUpload($request, $id);
            if ($image_info) {
                $data['book_image_name'] = $image_info['book_image_name'];
                $data['book_image_path'] = $image_info['book_image_path'];
                $this->productRepository->updateBookImage($data, $id, Config::get('settings.PRIMARY_IMAGE_YES'));
                unset($data['book_image_name']);
                unset($data['book_image_path']);
            }

            // Store images
            $image_info = $this->baseController->fineUpload($request, $id);
            if ($image_info) {
                $data['book_image_name'] = $image_info['book_image_name'];
                $data['book_image_path'] = $image_info['book_image_path'];
            }

            $product = $this->productRepository->updateProduct($data, $id);
            if ($product) {
                $response = [
                    'message' => 'Product updated successfully.',
                    'status' => 'success',
                    'data'    => $product->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Product not created.',
                    'status' => 'danger',
                ];
            }

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('response', $response);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->productRepository->deleteProduct($id);
        if ($deleted) {
            $response = [
                'message' => 'Product successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Product not deleted.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $uuid
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id, $uuid)
    {
        $image_info = $this->baseController->fineDeleteImage($id, $uuid);
        $image_info = $this->productRepository->deleteImageFromDB($id, $uuid);
        return response()->json(['success' => true]);
        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Product deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Product deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getImage($id)
    {
        //$directory = public_path('images/1');
        $files = array();
        $images = glob(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$id."/*");
        for ($i=0; $i<count($images); $i++) { 
            $file = array();
            $image = $images[$i];
            $info = pathinfo($image);
            $file_name =  basename($image,'.'.$info['extension']);
            $file['name'] = basename($image);
            $file['uuid'] = $file_name;
            $file['thumbnailUrl'] = url(Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$id.'/' . $file['name']);
            $files[] = $file;
        }

        // foreach (glob('./images/1/*.*') as $image) {
        //   echo $image;
        // }
        // $files = array(
        //     'name' => 'Untitled.png',
        //     'uuid' => '775257bc-966b-4ec6-a6ed-2fa7802532ff',
        //     'thumbnailUrl' => url('images/1/' . '775257bc-966b-4ec6-a6ed-2fa7802532ff.jpg')
        // );
        return response()->json($files);
    }

    /**
     * Ajax search for auto-complete
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function productSearchAjax(Request $request)
    {
        $data = $request->all();
        if (isset($data['product_name'])) {
            $products = $this->productRepository->getAjaxByProductName($data['product_name']);
        }

        if (count($products))
            return response()->json($products);
        else
            return ['value'=>'No Result Found'];
    }
}
