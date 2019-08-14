<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BooksetRepository;
use App\Validators\BooksetValidator;
use App\Entities\InstitutionBoardStandardBookset;
use App\Entities\InstitutionBoardStandardSubject;
use App\Entities\InstitutionBooksetVendorPrice;
use App\Entities\InstitutionBookVendorPrice;
use App\Entities\InstitutionBoardStandard;
use App\Entities\BooksetDescription;
use App\Entities\InstitutionVendor;
use App\Entities\BookStandard;
use App\Entities\BooksetImage;
use App\Entities\BooksetBook;
use App\Entities\BookImage;
use App\Entities\BookBoard;
use App\Entities\Standard;
use App\Entities\Bookset;
use App\Entities\Subject;
use App\Entities\Board;
use App\Entities\Book;
use Config;
use Auth;
use Log;
use DB;

/**
 * Class BooksetRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BooksetRepositoryEloquent extends BaseRepository implements BooksetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bookset::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return BooksetValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Convet null data to '-' dess in array
     *
     * @param string $key
     * @param string $value
     * @return array $books
     */
    protected function setData($key, $value)
    {
        array_walk_recursive($value, function (&$item, $key) {
            if ($key == 'sale_price' || $key == 'flinnt_charge' || $key == 'bookset_price') {
                $item = null === $item ? '0' : $item;
            } else {
                $item = null === $item ? 'Not Available' : $item;    
            }
        });
        $this->data[$key] = $value;
        return $this->data[$key];
    }

    /**
     * Get bookset list
     *
     * @return array $book_sets
     */
    public function getAllBooksetList()
    {
        $book_sets = Bookset::with(['ibsbookset.ibs.institution' => function($query) {
                                    $query->select('institution_id', 'institution_name');
                                }, 'ibsbookset.ibs.board' => function($query) {
                                    $query->select('board_id', 'board_name');
                                },'ibsbookset.ibs.standard' => function($query) {
                                    $query->select('standard_id', 'standard_name');
                                }])
                                ->select('book_set_id', 'book_set_name')
                                ->where('institution_id', Auth::guard('institution')->user()->institution_id)
                                ->get();

        /*$book_sets = Bookset::join('institution_board_standard_bookset', 'institution_board_standard_bookset.book_set_id', '=', 'book_set.book_set_id')
                ->join('institution_board_standard', 'institution_board_standard.institution_board_standard_id', '=', 'institution_board_standard_bookset.institution_board_standard_id')
                ->join('board', 'board.board_id', '=', 'institution_board_standard.board_id')
                ->join('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->where('book_set.institution_id', Auth::guard('institution')->user()->institution_id)
                ->get();*/

        foreach ($book_sets as $key => $book_set) {
            $book_set['total_sub'] = BooksetBook::where('book_set_id', $book_set->book_set_id)->distinct('subject_id')->count('subject_id');
            //$book_set['available_sub'] = BooksetBook::where('book_set_id', $book_set->book_set_id)->count('book_id');
            $book_set['total_vendor'] = BooksetBook::where('book_set_id', $book_set->book_set_id)->distinct('vendor_id')->count('vendor_id');
            $book_set['book_set_image_path'] = $this->getBooksetPrimaryImage($book_set->book_set_id);
        }

        return $book_sets;
    }

    /**
     * Get board dropdown list selected by institution
     *
     * @return array $boards
     */
    public function getBoardDropdown()
    {
        return Board::whereHas('ibs', function ($query) {
                        $query->where('institution_id', Auth::guard('institution')->user()->institution_id);
                    })
                    ->pluck('board_name', 'board_id');

        /*InstitutionBoardStandard::leftjoin('board', 'board.board_id', '=', 'institution_board_standard.board_id')->where('institution_id', Auth::guard('institution')->user()->institution_id)->pluck('board.board_name', 'institution_board_standard.board_id');*/
    }

    /**
     * Get standard dropdown list by board and institution
     *
     * @param int $board_id
     * @return array $standards
     */
    public function getStandardListByBoardId($board_id)
    {
        return Standard::whereHas('ibs', function ($query) use ($board_id) {
                        $query->where('board_id', $board_id)
                            ->where('institution_id', Auth::guard('institution')->user()->institution_id)
                            ->where('is_active', 1);
                    })
                    ->pluck('standard_name', 'standard_id');

        /*InstitutionBoardStandard::leftjoin('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->where('institution_id', Auth::guard('institution')->user()->institution_id)
                ->where('institution_board_standard.board_id', $board_id)
                ->where('institution_board_standard.is_active', 1)
                ->pluck('standard.standard_name', 'institution_board_standard.standard_id');*/
    }
    
    /**
     * Get subject dropdown list by board, standard and institution
     *
     * @param int $board_id
     * @param int $standard_id
     * @return array $subjects
     */
    public function getSubjectListByBoardStandard($board_id, $standard_id)
    {
        return Subject::whereHas('ibss', function ($query) use ($board_id, $standard_id) {
                        $query->where('institution_id', Auth::guard('institution')->user()->institution_id)
                            ->where('board_id', $board_id)
                            ->where('standard_id', $standard_id);
                    })
                    ->pluck('subject_name', 'subject_id');

        /*return InstitutionBoardStandardSubject::leftjoin('subject', 'subject.subject_id', '=', 'institution_board_standard_subject.subject_id')
                ->where('institution_id', Auth::guard('institution')->user()->institution_id)
                ->where('institution_board_standard_subject.board_id', $board_id)
                ->where('institution_board_standard_subject.standard_id', $standard_id)
                ->pluck('subject.subject_name', 'institution_board_standard_subject.subject_id');*/
    }

    /**
     * Create bookset
     *
     * @param array $data
     * @return array $bookset
     */
    public function createBookset($data)
    {
        try {
            DB::beginTransaction();
            $book_set = new Bookset();
            $book_set->institution_id = Auth::guard('institution')->user()->institution_id;
            $book_set->book_set_name = $data['book_set_name'];
            $book_set->is_active = $this->setCheckboxValue($data['is_active']);
            $book_set->save();

            if ($book_set) {
                $book_set_book = $this->createBooksetBook($data, $book_set->book_set_id);
                $book_set_description = $this->createBooksetDescription($data, $book_set->book_set_id);
                $institution_board_standard_bookset = $this->createInstitutionBoardStandardBookset($data, $book_set->book_set_id);
            }
            DB::commit();
            return $book_set;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('Create bookset.',['BooksetRepository/createBookset', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get Bookset's primary image name
     *
     * @param int $bookset_id
     * @return string $book_set_image_path
     */
    public function getBooksetPrimaryImage($book_set_id)
    {
        $primary_image = BooksetImage::where(['book_set_id' => $book_set_id, 'is_primary' => Config::get('settings.PRIMARY_IMAGE_YES')])->first();
        if (empty($primary_image)) {
            return Config::get('settings.BOOKSET_DEFAULT_IMAGE');
        }
        return $primary_image['book_set_image_path'];
    }

    /**
     * Get Book's primary image name
     *
     * @param int $book_id
     * @return string $book_image_path
     */
    public function getBookPrimaryImage($book_id)
    {
        $primary_image = BookImage::where(['book_id' => $book_id, 'is_primary' => Config::get('settings.PRIMARY_IMAGE_YES')])->first();
        if (empty($primary_image)) {
            return Config::get('settings.PRODUCT_DEFAULT_IMAGE');
        }
        return $primary_image['book_image_path'];
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
     * Store book set related description
     *
     * @param array $data
     * @param int $book_set_id
     * @return array $book_set_description
     */
    public function createBooksetDescription($data, $book_set_id)
    {
        try {
            $i = 1;
            foreach ($data['description'] as $key => $description) {
                $book_set_description = new BooksetDescription();
                $book_set_description->book_set_id = $book_set_id;
                $book_set_description->description = $description;
                $book_set_description->description_order = $i;
                $book_set_description->save();
                $i++;
            }
            return $book_set_description;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Store book set related description.',['BooksetRepository/createBooksetDescription', $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Store institution_board_standard_id with book_set_id
     *
     * @param array $data
     * @param int $book_set_id
     * @return array $institution_board_standard_bookset
     */
    public function createInstitutionBoardStandardBookset($data, $book_set_id)
    {
        try {
            $institution_board_standard_bookset = "";
            $board_std_data = $this->getInstitutionBoardStandard($data['board_id'], $data['standard_id']);
            if ($board_std_data) {
                $institution_board_standard_bookset = new InstitutionBoardStandardBookset();
                $institution_board_standard_bookset->institution_board_standard_id = $board_std_data->institution_board_standard_id;
                $institution_board_standard_bookset->book_set_id = $book_set_id;
                $institution_board_standard_bookset->save();
            }
            return $institution_board_standard_bookset;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Store institution_board_standard_id with book_set_id.',['BooksetRepository/createInstitutionBoardStandardBookset', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get institution_board_standard detail based on login institution id
     *
     * @param int $board_id
     * @param int $standard_id
     * @return array $institution_board_standard
     */
    public function getInstitutionBoardStandard($board_id, $standard_id)
    {   
        $institution_id = Auth::guard('institution')->user()->institution_id;
        return InstitutionBoardStandard::where('board_id', $board_id)
            ->where('standard_id', $standard_id)
            ->where('institution_id', $institution_id)
            ->first();
    }

    /**
     * Store book set related books
     *
     * @param array $data
     * @param int $book_set_id
     * @return array $book_set_book
     */
    public function createBooksetBook($data, $book_set_id)
    {
        try {
            foreach ($data['subject_id'] as $key => $subject_id) {
                $book_set_book = new BooksetBook();
                $book_set_book->book_set_id = $book_set_id;
                $book_set_book->subject_id = $subject_id;
                $book_set_book->save();
            }
            return $book_set_book;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Store book set related books.',['BooksetRepository/createBooksetBook', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store bookset set price by vendor id
     *
     * @param array $data
     * @return array $book_set_vendor_price
     */
    public function addBooksetPriceByVendor($data)
    {
        try {
            $vendor_id = Auth::guard('vendor')->user()->vendor_id;
            $book_set_price = $this->getInstitutionBooksetVendorPriceByBooksetId($data['book_set_id'], $vendor_id);
            if ($book_set_price) {
                $book_set_vendor_price = InstitutionBooksetVendorPrice::find($book_set_price->institution_book_set_vendor_id);
            } else {
                $book_set_vendor_price = new InstitutionBooksetVendorPrice();
            }
            $book_set_vendor_price->institution_id = $data['institution_id'];
            $book_set_vendor_price->book_set_id = $data['book_set_id'];
            $book_set_vendor_price->vendor_id = $vendor_id;
            $book_set_vendor_price->condition_id = 1;
            $book_set_vendor_price->list_price = $data['list_price'];
            $book_set_vendor_price->sale_price = $data['sale_price'];
            $book_set_vendor_price->is_active = 1;
            $book_set_vendor_price->is_preffered = Config::get('settings.PREFFERED_NO');
            $book_set_vendor_price->save();
            return $book_set_vendor_price;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Store bookset set price by vendor id.',['BooksetRepository/addBooksetPriceByVendor', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get book set vendor price by bookset id and vendor id
     *
     * @param int $book_set_id
     * @param int $vendor_id
     * @return array $institution_board_standard
     */
    public function getInstitutionBooksetVendorPriceByBooksetId($book_set_id, $vendor_id)
    {
        $book_set_vendor_price = InstitutionBooksetVendorPrice::where('book_set_id', $book_set_id)
            ->where('vendor_id', $vendor_id)
            ->first();
        if ($book_set_vendor_price) {
            return $book_set_vendor_price;    
        } else {
            return 0;
        }
        
    }

    /**
     * Get selected board, standard by book_set_id
     *
     * @param int $book_set_id
     * @return array $institution_board_standard
     */
    public function getInstitutionBoardStandardByBooksetId($book_set_id)
    {
        $book_set_data = InstitutionBoardStandardBookset::where('book_set_id', $book_set_id)->first();
        return InstitutionBoardStandard::find($book_set_data->institution_board_standard_id);
    }

    /**
     * Get selected subject by book_set_id
     *
     * @param int $book_set_id
     * @return array $assign_subjects
     */
    public function getBooksetSubjectByBooksetId($book_set_id)
    {
        $assign_subjects = [];
        $book_set_data = BooksetBook::where('book_set_id', $book_set_id)->get();
        if (count($book_set_data) > 0) {
            foreach ($book_set_data as $key => $book_set) {
                $subject_array[] = $book_set->subject_id;
            }
            $assign_subjects = $subject_array;
        }
        return $assign_subjects;
    }
    
    /**
     * Get descriptions by book_set_id
     *
     * @param int $book_set_id
     * @return array $descriptions
     */
    public function getBooksetDescriptionByBooksetId($book_set_id)
    {
        $descriptions = [];
        $book_set_descriptions = BooksetDescription::where('book_set_id', $book_set_id)->get();
        if (count($book_set_descriptions) > 0) {
            foreach ($book_set_descriptions as $key => $book_set_description) {
                $description_array[] = $book_set_description->description;
            }
            $descriptions = $description_array;
        }
        return $descriptions;
    }

    /**
     * Get selected books by book_set_id
     *
     * @param int $book_set_id
     * @return array $book_ids
     */
    public function getSelectedBooksByBooksetId($book_set_id)
    {
        $books_array = [];
        $book_ids = [];
        $book_set_books = BooksetBook::where('book_set_id', $book_set_id)->get();
        if (count($book_set_books) > 0) {
            foreach ($book_set_books as $key => $book_set_book) {
                $book_vendor_info = $this->getBookVendorInfo($book_set_book->book_id, $book_set_book->vendor_id, 1);
                if (isset($book_vendor_info) && !empty($book_vendor_info))
                $books_array[] = $book_vendor_info->institution_book_vendor_id;
            }
            $book_ids = $books_array;
        }
        return $book_ids;
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

    /**
     * Get Bookset's primary image name
     *
     * @param int $book_set_id
     * @return array $primary_image
     */
    public function getBoooksetPrimaryImage($book_set_id)
    {
        $primary_image = BooksetImage::where(['book_set_id' => $book_set_id, 'is_primary' => Config::get('settings.PRIMARY_IMAGE_YES')])->first();
        if (empty($primary_image)) {
            return Config::get('settings.BOOKSET_DEFAULT_IMAGE');
        }
        return $primary_image['book_set_image_path'];
    }

    /**
     * Get Book's vendor info by book_id, vendor_id, institution_id
     *
     * @param int $book_id
     * @param int $vendor_id
     * @param int $institution_id
     * @return array $institution_book_vendor_price
     */
    public function getBookVendorInfo($book_id, $vendor_id, $institution_id)
    {
        return InstitutionBookVendorPrice::where(['book_id' => $book_id, 'vendor_id' => $vendor_id, 'institution_id' => 1])->first();
    }

    /**
     * Find books for book set
     *
     * @param int $bookset
     * @return array $books
     */
    public function findBooks($bookset)
    {
        // echo "institution_id - ".Auth::guard('institution')->user()->institution_id.'</br>';
        // echo "board_id - ".$bookset['board_id'].'</br>';
        // echo "standard_id - ".$bookset['standard_id'].'</br>';
        
        $institution_id = Auth::guard('institution')->user()->institution_id;
        $vendors = $this->getSelectedVendorByInstitutionId($institution_id);
        // echo "vendor_id - ";
        // print_r($vendors);
        // echo '</br>';
        // echo "subject_id - ";
        // print_r($bookset['subject_id']);
        // echo "-------------";

        /*$products = InstitutionBookVendorPrice::join('book', 'book.book_id', '=', 'institution_book_vendor_price.book_id')
                ->join('book_board', 'book_board.book_id', '=', 'institution_book_vendor_price.book_id')
                ->join('book_standard', 'book_standard.book_id', '=', 'institution_book_vendor_price.book_id')
                ->join('board', 'board.board_id', '=', 'book_board.board_id')
                ->join('standard', 'standard.standard_id', '=', 'book_standard.standard_id')
                ->join('subject', 'subject.subject_id', '=', 'book.subject_id')
                ->join('publisher', 'publisher.publisher_id', '=', 'book.publisher_id')
                ->join('vendor', 'vendor.vendor_id', '=', 'institution_book_vendor_price.vendor_id')
                //->leftjoin('book_image', 'book_image.book_id', '=', 'institution_book_vendor_price.book_id')
                ->where('book_board.board_id', $bookset['board_id'])
                ->where('book_standard.standard_id', $bookset['standard_id'])
                ->whereIn('book.subject_id', $bookset['subject_id'])
                ->whereIn('institution_book_vendor_price.vendor_id', $vendors)
                ->get();*/

        $products = InstitutionBookVendorPrice::with(['book' => function($query) {
                            $query->select('book_id', 'book_name', 'subject_id', 'publisher_id');
                        }, 'book.board' => function ($query) use ($bookset){
                            $query->select('board.board_id', 'board_name');
                            $query->where('board.board_id', $bookset['board_id']);
                        }, 'book.standard' => function ($query) use ($bookset){
                            $query->select('standard.standard_id', 'standard_name');
                            $query->where('standard.standard_id', $bookset['standard_id']);
                        }, 'book.subject' => function ($query) {
                            $query->select('subject_id', 'subject_name');
                        }, 'book.publisher' => function ($query) {
                            $query->select('publisher_id', 'publisher_name');
                        }, 'vendor' => function ($query) {
                            $query->select('vendor_id', 'vendor_name');
                        }])
                        ->whereHas('book.board', function ($query) use ($bookset) {
                            $query->where('board.board_id', $bookset['board_id']);
                        })
                        ->whereHas('book.standard', function ($query) use ($bookset) {
                            $query->where('standard.standard_id', $bookset['standard_id']);
                        })
                        ->whereHas('book.subject', function ($query) use ($bookset) {
                            $query->whereIn('subject_id', $bookset['subject_id']);
                        })
                        ->whereIn('vendor_id', $vendors)
                        ->get();

        foreach ($products as $key => $product) {
            $product['book_image_path'] = $this->getBookPrimaryImage($product->book_id);
        }

        return $products;
    }
 
    /**
     * Update book set related information
     *
     * @param array $data
     * @param int $book_set_id
     * @return array $bookset
     */
    public function updateBookset($data, $book_set_id)
    {
        try {
            DB::beginTransaction();
            $book_set = Bookset::find($book_set_id);
            $book_set->institution_id = Auth::guard('institution')->user()->institution_id;
            $book_set->book_set_name = $data['book_set_name'];
            $book_set->is_active = isset($data['is_active']) ? $this->setCheckboxValue($data['is_active']) : 0;
            $book_set->save();

            if ($book_set) {
                $institution_board_standard_bookset = $this->updateInstitutionBoardStandardBookset($data, $book_set_id);
                $book_set_description = $this->updateBooksetDescription($data, $book_set_id);
                $book_set_book = $this->updateBooksetBook($data, $book_set_id);
            }
            DB::commit();
            return $book_set;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return false;
        }
    }

    /**
     * Delete and update description related data of bookset
     *
     * @param array $data
     * @param int $book_set_id
     * @return array $book_set_description
     */
    public function updateBooksetDescription($data, $book_set_id)
    {
        try {
            $delete = BooksetDescription::where('book_set_id', $book_set_id)->delete();
            if ($delete) {
                $book_set_description = $this->createBooksetDescription($data, $book_set_id);
                return $book_set_description;
            }
            return false;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Delete and update description related data of bookset.',['BooksetRepository/updateBooksetDescription', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete and update relational data of bookset
     *
     * @param array $data
     * @param int $book_set_id
     * @return array $institution_board_standard_bookset
     */
    public function updateInstitutionBoardStandardBookset($data, $book_set_id)
    {
        try {
            $delete = InstitutionBoardStandardBookset::where('book_set_id', $book_set_id)->delete();
            if ($delete) {
                $institution_board_standard_bookset = $this->createInstitutionBoardStandardBookset($data, $book_set_id);
                return $institution_board_standard_bookset;
            }
            return false;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Delete and update relational data of bookset.',['BooksetRepository/updateInstitutionBoardStandardBookset', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Add and update bookset related books
     *
     * @param array $data
     * @param int $book_set_id
     * @return array $book_set_description
     */
    public function updateBooksetBook($data, $book_set_id)
    {
        try {
            DB::beginTransaction();
            $institution_board_standard_bookset = "";
            $delete = BooksetBook::where('book_set_id', $book_set_id)->delete();
            if ($delete) {
                $institution_board_standard_bookset = $this->createBooksetBook($data, $book_set_id);
            }

            $institutionBoardStandard = $this->getInstitutionBoardStandardByBooksetId($book_set_id);

            if (isset($data['book_ids'])) {
                foreach ($data['book_ids'] as $key => $book_id) {
                    $vendor_book_data = InstitutionBookVendorPrice::find($book_id);
                    $book_data = Book::find($vendor_book_data['book_id']);

                    $standard_ids = BookStandard::where('book_id', $vendor_book_data['book_id'])
                        ->pluck('standard_id')->toArray();
                    $board_ids = BookBoard::where('book_id', $vendor_book_data['book_id'])
                        ->pluck('board_id')->toArray();

                    if (in_array($institutionBoardStandard->standard_id, $standard_ids) && in_array($institutionBoardStandard->board_id, $board_ids) ) {
                        /*print_r($institutionBoardStandard->standard_id);
                        print_r($institutionBoardStandard->board_id);
                        echo "-";
                        print_r($standard_ids);
                        echo "=-";
                        print_r($board_ids);
                        echo "=======";
                        var_dump(in_array($institutionBoardStandard->standard_id, $standard_ids));
                        var_dump(in_array($institutionBoardStandard->board_id, $board_ids));

                        die;*/

                        // Delete old entry and create new entry
                        BooksetBook::where('subject_id', $book_data['subject_id'])->where('book_set_id', $book_set_id)->where('vendor_id', Null)->delete();

                        $bookset_book = new BooksetBook();
                        $bookset_book->subject_id = $book_data['subject_id'];
                        $bookset_book->book_set_id = $book_set_id;
                        $bookset_book->book_id = $vendor_book_data['book_id'];
                        $bookset_book->vendor_id = $vendor_book_data['vendor_id'];
                        $bookset_book->save();
                        /*BooksetBook::where('subject_id', $book_data['subject_id'])
                            ->where('book_set_id', $book_set_id)
                            ->update(['book_id' => $vendor_book_data['book_id'], 
                                    'vendor_id' => $vendor_book_data['vendor_id']]);*/
                    }
                }
            }
            DB::commit();
            return $institution_board_standard_bookset;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('Add and update bookset related books.',['BooksetRepository/updateBooksetBook', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Add/Update bookset related images.
     *
     * @param array $data
     * @param int $book_set_id
     * @param int $is_primary
     * @return array $bookset
     */
    public function updateBooksetImage($data, $book_set_id, $is_primary = 0)
    {
        try {
            DB::beginTransaction();
            $book_image = "";
            if (isset($data['book_set_image_name'])) {
                if ($is_primary == Config::get('settings.PRIMARY_IMAGE_YES')) {
                    BooksetImage::where('book_set_id', $book_set_id)->update(['is_primary' => Config::get('settings.PRIMARY_IMAGE_NO')]);
                }

                $book_image = new BooksetImage();
                $book_image->book_set_id = $book_set_id;
                $book_image->book_set_image_name = $data['book_set_image_name'];
                $book_image->book_set_image_path = $data['book_set_image_path'];
                $book_image->book_set_image_order = 1;
                $book_image->is_primary = $is_primary;
                $book_image->save();
            }
            DB::commit();
            return $book_image;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('Add/Update bookset related images.',['BooksetRepository/updateBooksetImage', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete Bookset image by book set id, image name
     *
     * @param int $book_set_id
     * @param string $uuid
     * @return array $bookset_image
     */
    public function deleteImageFromDB($book_set_id, $uuid)
    {
        try {
            return BooksetImage::where('book_set_id', $book_set_id)
                ->where('book_set_image_name', 'like', '%'.$uuid.'%')->delete();
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Delete Bookset image by book set id, image name.',['BooksetRepository/deleteImageFromDB', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get book list for book set
     *
     * @param array $data
     * @return array $books
     */
    public function getBookListByBooksetId($data)
    {
        $books = Bookset::leftjoin('institution_board_standard_bookset', 'institution_board_standard_bookset.book_set_id', '=', 'book_set.book_set_id')
                ->leftjoin('institution_board_standard', 'institution_board_standard.institution_board_standard_id', '=', 'institution_board_standard_bookset.institution_board_standard_id')
                ->leftjoin('book_set_book', 'book_set_book.book_set_id', '=', 'book_set.book_set_id')
                ->leftjoin('book', 'book.book_id', '=', 'book_set_book.book_id')
                ->leftjoin('board', 'board.board_id', '=', 'institution_board_standard.board_id')
                ->leftjoin('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->leftjoin('publisher', 'publisher.publisher_id', '=', 'book.publisher_id')
                ->leftjoin('vendor', 'vendor.vendor_id', '=', 'book_set_book.vendor_id')
                ->leftjoin('subject', 'subject.subject_id', '=', 'book_set_book.subject_id');
                //->leftjoin('book_set_image', 'book_set_image.book_set_id', '=', 'book_set.book_set_id')
        if ($data['bookset_id']) {
            $books = $books->where('book_set.book_set_id', $data['bookset_id']);
        }

        // if (Auth::guard('institution')->check()) {
        //     //$books = $books->where('book_set.institution_id', Auth::guard('institution')->user()->institution_id);
        //     $books = $books->when($data, function ($books) use ($data) {
        //                 $books->where('book_set_book.vendor_id', $data['vendor_id'])
        //                     ->orWhereNull('book_set_book.vendor_id');
        //             });
        // }

        /*if (Auth::guard('vendor')->check()) {
            $books = $books->where('book_set_book.vendor_id', Auth::guard('vendor')->user()->vendor_id);
        }*/

        $books = $books->get();
        //$vendor_id = Auth::guard('vendor')->user()->vendor_id;
        //$book_set_price = $this->getInstitutionBooksetVendorPriceByBooksetId($bookset_id, $vendor_id);
        foreach ($books as $key => $book) {
            if (Auth::guard('institution')->check() && isset($data['vendor_id'])) {
                if ($book->vendor_id != Null && $book->vendor_id != $data['vendor_id'])
                    unset($books[$key]);
            }

            if (Auth::guard('vendor')->check()) {
                $vendor_id = Auth::guard('vendor')->user()->vendor_id;
                if ($book->vendor_id != Null && $book->vendor_id != $vendor_id){
                    unset($books[$key]);
                }
                $book_set_price = $this->getInstitutionBooksetVendorPriceByBooksetId($data['bookset_id'], $vendor_id);
            }

            $book['book_image_path'] = $this->getBookPrimaryImage($book->book_id);
/*            echo "<pre>";
            print_r($book);
            die;*/
            $book_vendor_info = $this->getBookVendorInfo($book->book_id, $book->vendor_id, $book->institution_id);
            $book['sale_price'] = ($book_vendor_info) ? $book_vendor_info['sale_price'] : 0;
            $book['bookset_price'] = (isset($book_set_price)) ? $book_set_price['sale_price'] : 0;
        }

        $books = $this->setData("booklist", $books->toArray());
        return $books;
    }

    /**
     * Get bookset list for login vendor
     *
     * @return array $boards
     */
    public function getAllBooksetListForVendor()
    {
        $vendor_id = Auth::guard('vendor')->user()->vendor_id;
        
        /*$book_sets = Bookset::join('institution_board_standard_bookset', 'institution_board_standard_bookset.book_set_id', '=', 'book_set.book_set_id')
                ->join('institution_board_standard', 'institution_board_standard.institution_board_standard_id', '=', 'institution_board_standard_bookset.institution_board_standard_id')
                ->join('book_set_book', 'book_set_book.book_set_id', '=', 'book_set.book_set_id')
                ->join('board', 'board.board_id', '=', 'institution_board_standard.board_id')
                ->join('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->join('institution', 'institution.institution_id', '=', 'institution_board_standard.institution_id')
                ->where('book_set_book.vendor_id', $vendor_id)
                ->distinct('book_set_id')
                ->get();*/

        $book_sets = Bookset::with(['ibsbookset' => function ($query) {
                            $query->select('book_set_id', 'institution_board_standard_id');
                        }, 'ibsbookset.ibs' => function ($query) {
                            $query->select('institution_board_standard_id', 'board_id', 'standard_id', 'institution_id');
                        }, 'ibsbookset.ibs.board' => function ($query) {
                            $query->select('board_id', 'board_name');
                        }, 'ibsbookset.ibs.standard' => function ($query) {
                            $query->select('standard_id', 'standard_name');
                        }, 'ibsbookset.ibs.institution' => function ($query) {
                            $query->select('institution_id', 'institution_name');
                        }])
                        ->whereHas('booksetbook', function ($query) use ($vendor_id) {
                            $query->where('vendor_id', $vendor_id);
                        })
                        ->get();
        
        $id = 0;
        foreach ($book_sets as $key => $book_set) {
            if ($id != $book_set->book_set_id) {
                $id = $book_set->book_set_id;

                $book_set['total_sub'] = BooksetBook::where('book_set_id', $book_set->book_set_id)->distinct('subject_id')->count('subject_id');
                $book_set['available_sub'] = BooksetBook::where('book_set_id', $book_set->book_set_id)->where('vendor_id', $vendor_id)->distinct('vendor_id')->count('subject_id');
                $book_set['book_set_image_path'] = $this->getBooksetPrimaryImage($book_set->book_set_id);
                $book_set_price = $this->getInstitutionBooksetVendorPriceByBooksetId($book_set->book_set_id, $vendor_id);
                $book_set['bookset_price'] =  ($book_set_price) ? $book_set_price['sale_price'] : 0;
            } else {
                unset($book_sets[$key]);
            }
        }

        return $book_sets;
    }

    /**
     * Get bookset list for login vendor
     *
     * @param int $bookset_id
     * @return array $boards
     */
    public function getBooksetInfoForInstitution($bookset_id)
    {
        $institution_id = Auth::guard('institution')->user()->institution_id;
        
        /*$book_sets = Bookset::join('institution_board_standard_bookset', 'institution_board_standard_bookset.book_set_id', '=', 'book_set.book_set_id')
                ->join('institution_board_standard', 'institution_board_standard.institution_board_standard_id', '=', 'institution_board_standard_bookset.institution_board_standard_id')
                ->join('institution_bookset_vendor_price', 'institution_bookset_vendor_price.book_set_id', '=', 'book_set.book_set_id')
                ->join('board', 'board.board_id', '=', 'institution_board_standard.board_id')
                ->join('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->join('vendor', 'vendor.vendor_id', '=', 'institution_bookset_vendor_price.vendor_id')
                ->where('institution_bookset_vendor_price.institution_id', $institution_id)
                ->where('institution_bookset_vendor_price.book_set_id', $bookset_id)
                ->get();*/

        $book_sets = InstitutionBooksetVendorPrice::with(['bookset' => function($query) {
                            $query->select('book_set_id', 'book_set_name');
                        }, 'bookset.ibsbookset' => function ($query) {
                            $query->select('institution_board_standard_bookset_id', 'institution_board_standard_id', 'book_set_id');
                        }, 'bookset.ibsbookset.ibs' => function ($query) {
                            $query->select('institution_board_standard_id', 'board_id', 'standard_id');
                        }, 'bookset.ibsbookset.ibs.board' => function ($query) {
                            $query->select('board_id', 'board_name');
                        }, 'bookset.ibsbookset.ibs.standard' => function ($query) {
                            $query->select('standard_id', 'standard_name');
                        }, 'vendor' => function ($query) {
                            $query->select('vendor_id', 'vendor_name');
                        }])
                        ->where('institution_id', $institution_id)
                        ->where('book_set_id', $bookset_id)
                        ->get();

        foreach ($book_sets as $key => $book_set) {
            // $book_set['total_sub'] = BooksetBook::where('book_set_id', $book_set->book_set_id)->count('subject_id');
            // $book_set['available_sub'] = BooksetBook::where('book_set_id', $book_set->book_set_id)->count('book_id');
            $book_set['book_set_image_path'] = $this->getBooksetPrimaryImage($book_set->book_set_id);
            // $book_set_price = $this->getInstitutionBooksetVendorPriceByBooksetId($book_set->book_set_id, $vendor_id);
            /*$book_set_price = 0;
            $book_set['bookset_price'] =  ($book_set_price) ? $book_set_price['sale_price'] : 0;*/
        }

        /*echo "<pre>";
        print_r($book_sets->toArray());
        die;*/
        return $book_sets;
    }

    /**
     * Set bookset prefered by institution id
     *
     * @param int $book_set_id
     * @param int $vendor_id
     * @return array $book_set_description
     */
    public function setBooksetPrefferedByInstitution($book_set_id, $vendor_id)
    {
        try {
            $disable = InstitutionBooksetVendorPrice::where('book_set_id', $book_set_id)->update(['is_preffered' => Config::get('settings.PREFFERED_NO') ]);
            if ($disable) {
                $book_set = InstitutionBooksetVendorPrice::where('book_set_id', $book_set_id)
                    ->where('vendor_id', $vendor_id)
                    ->update(['is_preffered' => Config::get('settings.PREFFERED_YES') ]);
                return $book_set;
            }
            return false;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Set bookset prefered by institution id.',['BooksetRepository/setBooksetPrefferedByInstitution', $e->getMessage()]);
            return false;
        }
    }


    /**
     * Front side function
     */


    /**
     * Get list of bookset
     *
     * @param int $standard_id
     * @return array $book_sets
     */
    public function getAllBooksets($standard_id = "")
    {
        $products = InstitutionBooksetVendorPrice::join('book_set', 'book_set.book_set_id', '=', 'institution_bookset_vendor_price.book_set_id')
                ->join('institution_board_standard_bookset', 'institution_board_standard_bookset.book_set_id', '=', 'book_set.book_set_id')
                ->join('institution_board_standard', 'institution_board_standard.institution_board_standard_id', '=', 'institution_board_standard_bookset.institution_board_standard_id')
                ->join('board', 'board.board_id', '=', 'institution_board_standard.board_id')
                ->join('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->join('vendor', 'vendor.vendor_id', '=', 'institution_bookset_vendor_price.vendor_id')
                // ->join('book_set_image', 'book_set_image.book_set_id', '=', 'book_set.book_set_id')
                // ->where('book_set_image.is_primary', Config::get('settings.PRIMARY_IMAGE_YES'))
                ->where('institution_bookset_vendor_price.is_preffered', Config::get('settings.PREFFERED_YES'));

        if (isset($standard_id) && !empty($standard_id)) {
            $products = $products->where('standard.standard_id', $standard_id);
        }

        $products = $products->orderBy('standard.standard_name', 'ASC')
                ->get();

        foreach ($products as $key => $product) {
            $product['book_set_image_path'] = $this->getBooksetPrimaryImage($product->book_set_id);
        }

        return $products;
    }

    /**
     * Get other vendor list who are selling same bookset by bookset id
     *
     * @param int $book_set_id
     * @param int $vendor_id
     * @return array $institution_bookset_vendor_price
     */
    public function getVendorListByBooksetId($book_set_id, $vendor_id)
    {
        return InstitutionBooksetVendorPrice::join('book_set', 'book_set.book_set_id', '=', 'institution_bookset_vendor_price.book_set_id')
                    ->join('vendor', 'vendor.vendor_id', '=', 'institution_bookset_vendor_price.vendor_id')
                    ->where('institution_bookset_vendor_price.book_set_id', $book_set_id)
                    ->where('institution_bookset_vendor_price.vendor_id', '!=' ,$vendor_id)
                    ->get();
    }

    /**
     * Get list of all bookset related images
     *
     * @param int $book_set_id
     * @return array $bookset_image
     */
    public function getBooksetRelatedImages($book_set_id)
    {
        $images = BooksetImage::where('book_set_id', $book_set_id)->orderBy('is_primary', 'DESC')->get();
        return $images;
    }

    /**
     * Get book set vendor price info
     *
     * @param int $institution_bookset_vendor_price_id
     * @return array $institution_bookset_vendor_price
     */
    public function getBooksetVendorPriceInfo($institution_book_set_vendor_id)
    {
        return InstitutionBooksetVendorPrice::join('vendor', 'vendor.vendor_id', '=', 'institution_bookset_vendor_price.vendor_id')
                ->where('institution_book_set_vendor_id', $institution_book_set_vendor_id)->firstOrFail();
    }

    /**
     * Get book list for book set
     *
     * @param array $data
     * @return array $books
     */
    public function getBookListByBookData($data)
    {
        $books = Bookset::leftjoin('institution_board_standard_bookset', 'institution_board_standard_bookset.book_set_id', '=', 'book_set.book_set_id')
                ->leftjoin('institution_board_standard', 'institution_board_standard.institution_board_standard_id', '=', 'institution_board_standard_bookset.institution_board_standard_id')
                ->leftjoin('book_set_book', 'book_set_book.book_set_id', '=', 'book_set.book_set_id')
                ->leftjoin('book', 'book.book_id', '=', 'book_set_book.book_id')
                ->leftjoin('board', 'board.board_id', '=', 'institution_board_standard.board_id')
                ->leftjoin('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->leftjoin('publisher', 'publisher.publisher_id', '=', 'book.publisher_id')
                ->leftjoin('vendor', 'vendor.vendor_id', '=', 'book_set_book.vendor_id')
                ->leftjoin('subject', 'subject.subject_id', '=', 'book_set_book.subject_id');

        if ($data['bookset_id']) {
            $books = $books->where('book_set.book_set_id', $data['bookset_id']);
        }

        $books = $books->get();

        foreach ($books as $key => $book) {
            if ($book->vendor_id != Null && $book->vendor_id != $data['vendor_id'])
                unset($books[$key]);

            $book['book_image_path'] = $this->getBookPrimaryImage($book->book_id);

            $book_vendor_info = $this->getBookVendorInfo($book->book_id, $book->vendor_id, $book->institution_id);
            $book['sale_price'] = ($book_vendor_info) ? $book_vendor_info['sale_price'] : 0;
        }

        $books = $this->setData("booklist", $books->toArray());
        return $books;
    }

    /**
     * Get book set name
     *
     * @return array
     */
    public function getBooksetStandards()
    {
        return Standard::whereHas('ibs.ibsbookset.ibooksetvendorprice', function ($query) {
                                    $query->where('is_preffered', Config::get('settings.PREFFERED_YES'));
                                })
                                ->pluck('standard_name', 'standard_id');

        /*return InstitutionBooksetVendorPrice::leftjoin('institution_board_standard_bookset', 'institution_board_standard_bookset.book_set_id', '=', 'institution_bookset_vendor_price.book_set_id')
            ->leftjoin('institution_board_standard', 'institution_board_standard.institution_board_standard_id', '=', 'institution_board_standard_bookset.institution_board_standard_id')
            ->leftjoin('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
            ->where('institution_bookset_vendor_price.is_preffered', Config::get('settings.PREFFERED_YES'))
            ->pluck('standard.standard_name', 'standard.standard_id');*/
    }
}