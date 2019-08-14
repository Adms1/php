<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductRepository;
//use App\Entities\Product;
use App\Validators\ProductValidator;
use App\Entities\InstitutionBookVendorPrice;
use App\Entities\InstitutionVendor;
use App\Entities\BookCategoryTree;
use App\Entities\BookDescription;
use App\Entities\BookAttribute;
use App\Entities\BookStandard;
use App\Entities\BookAuthor;
use App\Entities\BookVendor;
use App\Entities\BookBoard;
use App\Entities\BookImage;
use App\Entities\Book;
use Config;
use Auth;
use Log;
use DB;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return ProductValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
 
    /**
     * Get List of products by current login vendor
     *
     * @return int $products
     */
    public function getBookListByLoginVendor()
    {
        //print_r("<pre>");
        //print_r($data);
        $books = BookVendor::with(['book' => function ($query) {
                            $query->select('book_id', 'publisher_id', 'book_name', 'isbn', 'series', 'hs_code');
                        }, 'book.publisher' => function ($query) {
                            $query->select('publisher_id', 'publisher_name');
                        }])
                        ->whereHas('book', function ($query) {
                            $query->where('is_active', '=', 1);
                        });

        if (Auth::guard('vendor')->check()) {
            $books = $books->where('vendor_id', Auth::guard('vendor')->user()->vendor_id);
        }

        if (Auth::guard('institution')->check()) {
            $institution_id = Auth::guard('institution')->user()->institution_id;
            $vendors = $this->getSelectedVendorByInstitutionId($institution_id);
            $books = $books->whereIn('vendor_id', $vendors);
        }

        $books = $books->orderBy('created_at', 'DESC')->get();

        if (!empty($books)) {
            foreach ($books as $key => $book) {
                $book->image = $this->getProductPrimaryImage($book->book_id);
            }
        }

        return $books;

        /*$books = DB::table('book')
            ->join('publisher', 'book.publisher_id', '=', 'publisher.publisher_id')
            ->join('book_vendor', 'book_vendor.book_id', '=', 'book.book_id');

        if (Auth::guard('vendor')->check()) {
            $books = $books->where('book_vendor.vendor_id', '=', Auth::guard('vendor')->user()->vendor_id);
        }

        if (Auth::guard('institution')->check()) {
            $institution_id = Auth::guard('institution')->user()->institution_id;
            $vendors = $this->getSelectedVendorByInstitutionId($institution_id);
            $books = $books->whereIn('book_vendor.vendor_id', $vendors);
        }

        $books = $books->where('book.is_active', '=', 1)->orderBy('book.created_at', 'DESC')->get();
        foreach ($books as $key => $book) {
            $book->image = $this->getProductPrimaryImage($book->book_id);
        }

        return $books;*/
    }

    /**
     * Create Product
     *
     * @param int $data
     * @return array $product
     */
    public function createProduct($data)
    {
        //print_r("<pre>");
        //print_r($data);
        try {
            DB::beginTransaction();
            $book = [];
            if ($data['product_type'] == 'book') {
                $book = $this->createBookProduct($data);
                $book_vendor_info = $this->createBookVendor($data, $book->book_id);
                $book_author_info = $this->createBookAuthor($data, $book->book_id);
                $book_category_tree_info = $this->createBookCategoryTree($data, $book->book_id);
                $book_description_info = $this->createBookDescription($data, $book->book_id);
                $book_institution_book_vendor_info = $this->createInstitutionBookVendorPrice($data, $book->book_id);
                $data['is_academic'] = isset($data['is_academic']) ? $this->setCheckboxValue($data['is_academic']) : 0;
                $data['is_active'] = isset($data['is_active']) ? $this->setCheckboxValue($data['is_active']) : 0;
                if ($data['is_academic'] == 1) {
                    $book_board_info = $this->createBookBoard($data, $book->book_id);
                    $book_standard_info = $this->createBookStandard($data, $book->book_id);
                }
            }
            DB::commit();
            return $book;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('Create Product.',['ProductRepository/createProduct', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Create Product which product type is book
     *
     * @param int $data
     * @return array $product
     */
    public function createBookProduct($data)
    {
        try {
            $book = new Book();
            $book->publisher_id = $data['publisher_id'];
            //$book->covertype_id = $data['covertype_id'];
            $book->language_id = $data['language_id'];
            $book->book_name = $data['name'];
            $book->isbn = $data['isbn'];
            $book->series = $data['year'];
            $book->format = $data['format'];
            $book->subject_id = $data['subject_id'];
            $book->book_guid = '';
            $book->hs_code = $data['hs_code'];
            $book->is_active = $this->setCheckboxValue($data['is_active']);
            $book->is_academic = isset($data['is_academic']) ? $this->setCheckboxValue($data['is_academic']) : 0;
            //$book->book_width = $data[];
            //$book->book_length = $data[];
            //$book->book_height = $data[];
            $book->save();
            return $book; 
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Create Product which product type is book.',['ProductRepository/createBookProduct', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Re-Set checkbox values
     *
     * @param string $value
     * @return string $int_value
     */
    public function setCheckboxValue($value)
    {
        $int_value = ($value == 'on')  ? 1 : 0;
        return $int_value;
    }

    /**
     * Relational table of author and book
     *
     * @param array $data
     * @return int $book_id
     */
    public function createBookAuthor($data, $book_id)
    {
        try {
            $book_author = "";
            if ($data['author_id']) {
                foreach ($data['author_id'] as $key => $author_id) {
                    $book_author = new BookAuthor();
                    $book_author->book_id = $book_id;
                    $book_author->author_id = $author_id;
                    $book_author->save();   
                }
            }
            return $book_author;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Relation of author and book.',['ProductRepository/createBookAuthor', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get author by book id
     *
     * @param array $data
     * @return int $id
     */
    public function getBookAuthor($id)
    {
        return BookAuthor::leftjoin('author', 'author.author_id', '=', 'book_author.author_id')
                    ->where('book_id', $id)->get();
    }

    /**
     * Relational table of vendor and book
     *
     * @param array $data
     * @return int $book_id
     */
    public function createBookVendor($data, $book_id)
    {
        try {
            $book_vendor = new BookVendor();
            $book_vendor->book_id = $book_id;
            $book_vendor->vendor_id = Auth::guard('vendor')->user()->vendor_id;
            $book_vendor->save();
            return $book_vendor;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Relational of vendor and book.',['ProductRepository/createBookVendor', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get vendor by book id
     *
     * @param int $id
     * @return array $data
     */
    public function getBookVendor($id)
    {
        return BookVendor::where('book_id', $id)->get();
    }

    /**
     * Relational table of board and book
     *
     * @param array $data
     * @return int $book_id
     */
    public function createBookBoard($data, $book_id)
    {
        try {
            $book_board = "";
            if (isset($data['board_id'])) {
                foreach ($data['board_id'] as $key => $board_id) {
                    $book_board = new BookBoard();
                    $book_board->book_id = $book_id;
                    $book_board->board_id = $board_id;
                    $book_board->save();
                }
            }
            return $book_board;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Relational of board and book.',['ProductRepository/createBookBoard', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get board by book id
     *
     * @param array $data
     * @return int $id
     */
    public function getBookBoard($id)
    {
        return BookBoard::where('book_id', $id)->get();
    }

    /**
     * Relational table of standard and book
     *
     * @param array $data
     * @return int $book_id
     */
    public function createBookStandard($data, $book_id)
    {
        try {
            $book_standard = "";
            if (isset($data['standard_id'])) {
                foreach ($data['standard_id'] as $key => $standard_id) {
                    $book_standard = new BookStandard();
                    $book_standard->book_id = $book_id;
                    $book_standard->standard_id = $standard_id;
                    $book_standard->save();
                }
            }
            return $book_standard;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Relational of standard and book.',['ProductRepository/createBookStandard', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get standard by book id
     *
     * @param array $data
     * @return int $id
     */
    public function getBookStandard($id)
    {
        return BookStandard::where('book_id', $id)->get();
    }

    /**
     * Relational table of Category Tree and book
     *
     * @param array $data
     * @return int $book_id
     */
    public function createBookCategoryTree($data, $book_id)
    {
        try {
            $book_category_tree = "";
            if ($data['category_id']) {
                foreach ($data['category_id'] as $key => $category_id) {
                    $book_category_tree = new BookCategoryTree();
                    $book_category_tree->book_id = $book_id;
                    $book_category_tree->category_tree_id = $category_id;
                    $book_category_tree->save();
                }
            }
            return $book_category_tree;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Relational of Category Tree and book.',['ProductRepository/createBookCategoryTree', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get Book Category Tree by book id
     *
     * @param array $data
     * @return int $id
     */
    public function getBookCategoryTree($id)
    {
        return BookCategoryTree::where('book_id', $id)->get();
    }

    /**
     * Relational table of Description and book
     *
     * @param array $data
     * @return int $book_id
     */
    public function createBookDescription($data, $book_id)
    {
        try {
            $book_category_tree = "";
            $i = 1;
            foreach ($data['description'] as $key => $description) {
                $book_description = new BookDescription();
                $book_description->book_id = $book_id;
                $book_description->description = $description;
                $book_description->description_order = $i;
                $book_description->save();
                $i++;
            }
            return $book_description;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Relational of Description and book.',['ProductRepository/createBookDescription', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get Book Description by book id
     *
     * @param array $data
     * @return int $id
     */
    public function getBookDescription($id)
    {
        return BookDescription::where('book_id', $id)->get();
    }

    /**
     * Relational table of institutio,book,vendor'price 
     *
     * @param array $data
     * @return int $book_id
     */
    public function createInstitutionBookVendorPrice($data, $book_id)
    {
        try {
            $book_institution_book_vendor = new InstitutionBookVendorPrice();
            $book_institution_book_vendor->institution_id = 1;
            $book_institution_book_vendor->book_id = $book_id;
            $book_institution_book_vendor->vendor_id = Auth::guard('vendor')->user()->vendor_id;
            $book_institution_book_vendor->condition_id = 1;
            $book_institution_book_vendor->list_price = $data['list_price'];
            $book_institution_book_vendor->sale_price = $data['display_price'];
            $book_institution_book_vendor->is_preffered = Config::get('settings.PREFFERED_NO');
            $book_institution_book_vendor->save();
            return $book_institution_book_vendor;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Relational of institutio,book,vendor price.',['ProductRepository/createInstitutionBookVendorPrice', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get Book Description by book id
     *
     * @param array $data
     * @return int $id
     */
    public function getInstitutionBookVendorPrice($id)
    {
        $vendor_id = Auth::guard('vendor')->user()->vendor_id;
        return InstitutionBookVendorPrice::where(['book_id' => $id, 'institution_id' => 1, 'vendor_id' => $vendor_id])->first();
    }

    /**
     * Update Product
     *
     * @param int $data
     * @param int $book_id
     * @return array $product
     */
    public function updateProduct($data, $book_id)
    {
        try {
            DB::beginTransaction();
            $book = [];
            $book_image_info = $this->updateBookImage($data, $book_id);
            if ($data['product_type'] == 'book') {
                $book = $this->updateBookProduct($data, $book_id);
                $book_author_info = $this->updateBookAuthor($data, $book_id);
                $book_category_tree_info = $this->updateBookCategoryTree($data, $book_id);
                $book_description_info = $this->updateBookDescription($data, $book_id);
                $book_institution_book_vendor_info = $this->updateInstitutionBookVendorPrice($data, $book->book_id);
                $data['is_academic'] = isset($data['is_academic']) ? $this->setCheckboxValue($data['is_academic']) : 0;
                $data['is_active'] = isset($data['is_active']) ? $this->setCheckboxValue($data['is_active']) : 0;
                if ($data['is_academic'] == 1) {
                    $book_board_info = $this->updateBookBorad($data, $book_id);
                    $book_standard_info = $this->updateBookStandard($data, $book_id);
                }
            }
            DB::commit();
            return $book;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('Update Product.',['ProductRepository/updateProduct', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update Product which product type is book
     *
     * @param int $data
     * @param int $book_id
     * @return array $product
     */
    public function updateBookProduct($data, $book_id)
    {
        try {
            $book = Book::find($book_id);
            $book->publisher_id = $data['publisher_id'];
            //$book->covertype_id = $data['covertype_id'];
            $book->language_id = $data['language_id'];
            $book->book_name = $data['name'];
            $book->isbn = $data['isbn'];
            $book->series = $data['year'];
            $book->format = $data['format'];
            $book->subject_id = $data['subject_id'];
            $book->book_guid = '';
            $book->hs_code = $data['hs_code'];
            $book->is_active = isset($data['is_active']) ? $this->setCheckboxValue($data['is_active']) : 0;
            $book->is_academic = isset($data['is_academic']) ? $this->setCheckboxValue($data['is_academic']) : 0;
            //$book->book_width = $data[];
            //$book->book_length = $data[];
            //$book->book_height = $data[];
            $book->save();
            return $book; 
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Update Product which product type is book.',['ProductRepository/updateBookProduct', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete and update relational table of author and book
     *
     * @param array $data
     * @param int $book_id
     * @return array $book_author
     */
    public function updateBookAuthor($data, $book_id)
    {
        $delete = BookAuthor::where('book_id', $book_id)->delete();
        if ($delete) {
            $book_author = $this->createBookAuthor($data, $book_id);
            return $book_author;
        }
        return false;
    }

    /**
     * Delete and update relational table of board and book
     *
     * @param array $data
     * @param int $book_id
     * @return array $book_board
     */
    public function updateBookBorad($data, $book_id)
    {
        BookBoard::where('book_id', $book_id)->delete();        
        $book_board = $this->createBookBoard($data, $book_id);
        return $book_board;
    }

    /**
     * Delete and update relational table of standard and book
     *
     * @param array $data
     * @param int $book_id
     * @return array $book_standard
     */
    public function updateBookStandard($data, $book_id)
    {
        BookStandard::where('book_id', $book_id)->delete();
        $book_standard = $this->createBookStandard($data, $book_id);
        return $book_standard;
    }

    /**
     * Delete and update Relational table of Category Tree and book
     *
     * @param array $data
     * @param int $book_id
     * @return array $book_category_tree
     */
    public function updateBookCategoryTree($data, $book_id)
    {
        $delete = BookCategoryTree::where('book_id', $book_id)->delete();
        if ($delete) {
            $book_category_tree = $this->createBookCategoryTree($data, $book_id);
            return $book_category_tree;
        }
        return false;
    }

    /**
     * Delete and update relational table of Description and book
     *
     * @param array $data
     * @param int $book_id
     * @return array $book_description
     */
    public function updateBookDescription($data, $book_id)
    {
        $delete = BookDescription::where('book_id', $book_id)->delete();
        if ($delete) {
            $book_description = $this->createBookDescription($data, $book_id);
            return $book_description;
        }
        return false;
    }

    /**
     * Upadte Relational table of institutio,book,vendor'price 
     *
     * @param array $data
     * @return int $book_id
     */
    public function updateInstitutionBookVendorPrice($data, $book_id)
    {
        try {
            $vendor_id = Auth::guard('vendor')->user()->vendor_id;
            $exist = $this->getInstitutionBookVendorPrice($book_id);
            if ($exist) {
                return InstitutionBookVendorPrice::where(['institution_id' => 1, 'vendor_id' => $vendor_id, 'book_id' => $book_id])->update(['list_price' => $data['list_price'], 'sale_price' => $data['display_price']]);
            } else {
                return $this->createInstitutionBookVendorPrice($data, $book_id);
            }
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Upadte Relational of institutio,book,vendor price .',['ProductRepository/updateInstitutionBookVendorPrice', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update book's image 
     *
     * @param array $data
     * @return int $book_id
     */
    public function updateBookImage($data, $book_id, $is_primary = 0)
    {
        try {
            $book_image = "";
            if (isset($data['book_image_name'])) {
            // $images = BookImage::where(['book_image_name' => $data['book_image_name'], 'book_id' => $book_id])->get();
            // if (count($images) > 0) {
            //     return true;
            // }
                if ($is_primary == Config::get('settings.PRIMARY_IMAGE_YES')) {
                    BookImage::where('book_id', $book_id)->update(['is_primary' => Config::get('settings.PRIMARY_IMAGE_NO')]);
                }

                $book_image = new BookImage();
                $book_image->book_id = $book_id;
                $book_image->book_image_name = $data['book_image_name'];
                $book_image->book_image_path = $data['book_image_path'];
                $book_image->book_image_order = 1;
                $book_image->is_primary = $is_primary;
                $book_image->save();
            }
            return $book_image;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Update books image.',['ProductRepository/updateBookImage', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete product by product Id
     *
     * @param int $product_id
     */
    public function deleteProduct($product_id)
    {
        return Book::where('book_id',$product_id)->update(['is_active' => 0]);
    }

    /**
     * Get List of products by searching product name
     *
     * @param string $product_name
     */
    public function getSearchListByProductName($product_name)
    {
        $vendor_books = BookVendor::where('book_vendor.vendor_id', Auth::guard('vendor')->user()->vendor_id)->pluck('book_id')->toArray();

        $products = Book::join('publisher', 'book.publisher_id', '=', 'publisher.publisher_id')
                        ->join('institution_book_vendor_price', 'institution_book_vendor_price.book_id', '=', 'book.book_id');

        if (Auth::guard('vendor')->check()) {
            $products = $products->where('institution_book_vendor_price.vendor_id', '!=', Auth::guard('vendor')->user()->vendor_id);
            $products = $products->whereNotIn('institution_book_vendor_price.book_id', $vendor_books);
        }

        $products = $products->where('book_name', 'LIKE', '%'.$product_name.'%')->where('book.is_active', '=', 1)->get();
        foreach ($products as $key => $product) {
            $product->image = $this->getProductPrimaryImage($product->book_id);
            $book_standard = BookStandard::where('book_id', $product->book_id)->select('standard_id')->first();
            if ($book_standard) {
                $product->standard_id = $book_standard->standard_id;
            }
        }
        return $products;
    }

    /**
     * Delete Book image by book id, image name
     *
     * @param int $book_id
     * @param varchr $book_name
     * @return array
     */
    public function deleteImageFromDB($book_id, $uuid)
    {
        return BookImage::where('book_id', $book_id)
            ->where('book_image_name', 'like', '%'.$uuid.'%')->delete();
    }

    /**
     * Get List of product name searching by ajax call
     *
     * @param string $product_name
     */
    public function getAjaxByProductName($product_name)
    {
        $products = Book::join('book_vendor', 'book_vendor.book_id', '=', 'book.book_id');

        if (Auth::guard('vendor')->check()) {
            $products = $products->where('book_vendor.vendor_id', '!=', Auth::guard('vendor')->user()->vendor_id);
        }

        $products = Book::where('book_name', 'LIKE', '%'.$product_name.'%')->where('book.is_active', '=', 1)->pluck('book_name', 'book_id');

        return $products;
    }

    /**
     * Store Vendor offer about product
     *
     * @param array $data
     * @param int $book_id
     * @return int $data
     */
    public function storeVendorOffer($data, $book_id)
    {
        $book = [];
        $book_vendor_info = $this->createBookVendor($data, $book_id);
        $book_institution_book_vendor_info = $this->createInstitutionBookVendorPrice($data, $book_id);
        return $book;
    }

    /**
     * Get list of attributes by product Id
     *
     * @param int $product_id
     */
    public function getAttributeList($product_id)
    {
        return BookAttribute::join('attribute', 'attribute.attribute_id', '=', 'book_attribute.attribute_id')->where('book_id',$product_id)->get();
    }

    /**
     * Get product detail by product_id
     */
    public function getProductByID($product_id)
    {
        $book_vendor = BookVendor::find($product_id);

        $books = Book::with(['publisher' => function ($query) {
                            $query->select('publisher_id', 'publisher_name');
                        }, 'language' => function ($query) {
                            $query->select('language_id', 'language_name');
                        }, 'subject' => function ($query) {
                            $query->select('subject_id', 'subject_name');
                        }, 'bookvendor' => function ($query) use ($book_vendor) {
                            $query->where('vendor.vendor_id', $book_vendor->vendor_id)
                                ->select('vendor.vendor_id', 'vendor_name');
                        }])
                        ->select('book_id', 'publisher_id', 'language_id', 'subject_id', 'book_name', 'isbn', 'series', 'format', 'hs_code')
                        ->find($book_vendor->book_id);

        /*$books = Book::leftjoin('book_vendor', 'book_vendor.book_id', '=', 'book.book_id')
                ->leftjoin('publisher', 'book.publisher_id', '=', 'publisher.publisher_id')
                ->leftjoin('language', 'book.language_id', '=', 'language.language_id')
                ->leftjoin('subject', 'book.subject_id', '=', 'subject.subject_id')
                ->leftjoin('vendor', 'book_vendor.vendor_id', '=', 'vendor.vendor_id')
                ->where('book.book_id', $book_vendor->book_id)
                ->where('vendor.vendor_id', $book_vendor->vendor_id)
                ->first();*/

        $book_price = InstitutionBookVendorPrice::where(['book_id' => $book_vendor->book_id, 'institution_id' => 1, 'vendor_id' => $book_vendor->vendor_id])->first();

        if (isset($book_price) && !empty($book_price)) {
            $books['sale_price'] = $book_price->sale_price;
            $books['list_price'] = $book_price->list_price;
        }

        if (isset($books) && !empty($books)) {
            $books['images'] = $this->getProductRelatedImages($books->book_id);
            $books['description'] = $this->getBookDescription($books->book_id);
            $books['authors'] = $this->getBookAuthor($books->book_id);
            $books['attribute'] = $this->getAttributeList($books->book_id);
            $books['book_vendors'] = $this->getVendorListByProductId($book_vendor->book_id, $book_vendor->vendor_id);
        }

        return $books;
    }

    /**
     * Get product's primary image name
     *
     * @param int $book_id
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
     * Front side function
     */


    /**
     * Get list of products
     */
    public function getAllProducts($category_id, $grade_id, $skip_id)
    {
        // $products = InstitutionBookVendorPrice::leftjoin('book', 'book.book_id', '=', 'institution_book_vendor_price.book_id')
        //         ->leftjoin('book_standard', 'book_standard.book_id', '=', 'book.book_id')
        //         ->leftjoin('book_image', 'book_image.book_id', '=', 'book.book_id');

        // if ($category_id) {
        //     $products = $products->leftjoin('book_category_tree', 'book_category_tree.book_id', '=', 'book.book_id')
        //             ->where('book_category_tree.category_tree_id', $category_id);
        // }

        // $products = $products->leftjoin('book_standard', 'book_standard.book_id', '=', 'book.book_id')
        //         ->where('book_image.is_primary', Config::get('settings.PRIMARY_IMAGE_YES'))
        //         ->take(6)
        //         ->orderBy('book.created_at', 'DESC')
        //         ->get();

        $products = InstitutionBookVendorPrice::join('book', 'book.book_id', '=', 'institution_book_vendor_price.book_id')
                // ->join('book_image', 'book_image.book_id', '=', 'book.book_id')
                ->join('book_standard', 'book_standard.book_id', '=', 'book.book_id')
                ->join('standard', 'standard.standard_id', '=', 'book_standard.standard_id');

        if ($category_id) {
            $products = $products->join('book_category_tree', 'book_category_tree.book_id', '=', 'book.book_id')
                    ->where('book_category_tree.category_tree_id', $category_id);
        }

        if ($grade_id) {
            $products = $products->where('book_standard.standard_id', $grade_id);
        }

        if ($skip_id) {
            $products = $products->where('institution_book_vendor_price.institution_book_vendor_id', '!=' ,$skip_id);
        }
        

        $products = $products/*->where('book_image.is_primary', Config::get('settings.PRIMARY_IMAGE_YES'))*/
                ->where('book.is_academic', Config::get('settings.ACADEMIC_YES'))
                ->orderBy('standard.standard_name', 'ASC')
                ->get();

        foreach ($products as $key => $product) {
            $product->book_image_path = $this->getProductPrimaryImage($product->book_id);
        }

        // Eloquent
        /**
        $products = InstitutionBookVendorPrice::with(['book' => function($query) {
            $query->with(['bookImage' => function($inner_query) {
                $inner_query->where('is_primary', Config::get('settings.PRIMARY_IMAGE_YES'));
            }, 'standard' => function($inner_query) {
                $inner_query->orderBy('standard.standard_name', 'ASC');
            }])->where('book.is_academic', Config::get('settings.ACADEMIC_YES'));
        }])->get();
        **/

        /*echo "<pre>";
        echo (count($products));*/

/*        SELECT st.standard_name,bs.book_id,ivp.institution_book_vendor_id,img.book_image_path,b.is_academic  FROM `str_institution_book_vendor_price` as ivp  inner JOIN str_book as b on ivp.`book_id`=b.book_id
inner JOIN str_vendor as v on v.vendor_id=ivp.vendor_id
inner join str_book_standard as bs on bs.book_id=b.book_id
inner join str_standard as st on st.standard_id=bs.standard_id
inner join str_book_image as img on img.book_id=b.book_id and img.is_primary=1
order by st.standard_name*/

        /*echo "*******";
        print_r($products);
        die;*/

        return $products;
    }

    /**
     * Get list of products
     */
    public function getFilteredProducts($category_id, $vendor_ids, $languages, $authors, $formats, $min, $max, $product_name = '', $sort = '')
    {
        $products = InstitutionBookVendorPrice::join('book', 'book.book_id', '=', 'institution_book_vendor_price.book_id')
                // ->join('book_image', 'book_image.book_id', '=', 'book.book_id')
                ->join('book_standard', 'book_standard.book_id', '=', 'book.book_id')
                ->join('standard', 'standard.standard_id', '=', 'book_standard.standard_id');

        if ($category_id) {
            $products = $products->join('book_category_tree', 'book_category_tree.book_id', '=', 'book.book_id')
                ->where('book_category_tree.category_tree_id', $category_id)
                ->select('category_tree_id');
        }

        if ($vendor_ids) {
            $products = $products->whereIn('institution_book_vendor_price.vendor_id',$vendor_ids);
        }

        if ($languages) {
            $products = $products->whereIn('book.language_id',$languages);
        }

        if ($formats) {
            $products = $products->whereIn('book.format',$formats);
        }

        if ($authors) {
            $products = $products->join('book_author', 'book_author.book_id', '=', 'book.book_id')
                    ->whereIn('book_author.author_id', $authors);
        }

        if ($min) {
            $products = $products->where('institution_book_vendor_price.sale_price','>',$min);
        }

        if ($max) {
            $products = $products->where('institution_book_vendor_price.sale_price','<',$max);
        }

        if ($product_name) {
            $products = $products->where('book_name', 'LIKE', '%'.$product_name.'%');
        }

        $products = $products/*->where('book_image.is_primary', Config::get('settings.PRIMARY_IMAGE_YES'))*/
                ->where('book.is_active', '=', 1)
                ->where('book.is_academic', Config::get('settings.ACADEMIC_YES'))
                ->select('institution_book_vendor_id', 'book.book_id', 'vendor_id', 'list_price', 'sale_price', 'language_id', 'subject_id', 'book_name', 'format', /*'book_image_id', 'book_image_name', 'book_image_path', */'book_standard_id', 'standard.standard_id', 'standard_name', 'institution_book_vendor_price.institution_id')
                ->orderBy('standard.standard_name', 'ASC');

        if ($sort) {
            $products = $products->orderBy('sale_price', $sort);
        }

        $products = $products->distinct()->get();

        foreach ($products as $key => $product) {
            $product->book_image_path = $this->getProductPrimaryImage($product->book_id);
        }

        return $products;
    }

    /**
     * Get book vendor price info
     *
     * @param int $institution_book_vendor_price_id
     */
    public function getBookVendorPriceInfo($institution_book_vendor_price_id)
    {
        //return InstitutionBookVendorPrice::firstOrFail($institution_book_vendor_price_id);
        return InstitutionBookVendorPrice::join('vendor', 'vendor.vendor_id', '=', 'institution_book_vendor_price.vendor_id')->find($institution_book_vendor_price_id);
    }

    /**
     * Get list of all product related images
     *
     * @param int $book_id
     */
    public function getProductRelatedImages($book_id)
    {
        $images = BookImage::where('book_id', $book_id)->orderBy('is_primary', 'DESC')->get();
        return $images;
    }

    /**
     * Get product info with publisher and lannguage details
     *
     * @param int $book_id
     */
    public function getProductDetail($book_id)
    {
        return Book::leftjoin('language', 'language.language_id', '=', 'book.language_id')
                    ->leftjoin('publisher', 'publisher.publisher_id', '=', 'book.publisher_id')
                    ->where('book.book_id', $book_id)->first();
    }

    /**
     * Get other vendor list who are selling same product by book id
     *
     * @param int $book_id
     */
    public function getVendorListByProductId($book_id, $vendor_id)
    {
        return InstitutionBookVendorPrice::join('book', 'book.book_id', '=', 'institution_book_vendor_price.book_id')
                    ->join('vendor', 'vendor.vendor_id', '=', 'institution_book_vendor_price.vendor_id')
                    ->where('institution_book_vendor_price.book_id', $book_id)
                    ->where('institution_book_vendor_price.vendor_id', '!=' ,$vendor_id)
                    ->get();
    }

    /**
     * Get selected vendors by login institution_id
     *
     * @param int $institution_id
     * @return array $vendors
     */
    public function getSelectedVendorByInstitutionId($institution_id)
    {
        $vendors = [];
        $selected_vendors = InstitutionVendor::where('institution_id', $institution_id)->get();
        if (count($selected_vendors) > 0) {
            foreach ($selected_vendors as $key => $selected_vendor) {
                $vendor_array[] = $selected_vendor->vendor_id;
            }
            $vendors = $vendor_array;
        }
        return $vendors;
    }
}