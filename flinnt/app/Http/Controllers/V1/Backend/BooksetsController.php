<?php

namespace App\Http\Controllers\V1\Backend;

/*use App\Http\Requests;*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Controllers\V1\Backend\BaseController;
use App\Http\Requests\BooksetCreateRequest;
use App\Http\Requests\BooksetUpdateRequest;
use App\Repositories\BooksetRepository;
use App\Validators\BooksetValidator;
use Config;

/**
 * Class BooksetsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class BooksetsController extends Controller
{
    /**
     * @var BooksetRepository
     */
    protected $booksetRepository;

    /**
     * @var BaseController
     */
    protected $baseController;

    /**
     * @var BooksetValidator
     */
    protected $validator;

    /**
     * BooksetsController constructor.
     *
     * @param BooksetRepository $booksetRepository
     * @param BaseController $baseController
     * @param BooksetValidator $validator
     */
    public function __construct(
        BooksetRepository $booksetRepository, 
        BaseController $baseController,
        BooksetValidator $validator)
    {
        $this->booksetRepository = $booksetRepository;
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
        $this->booksetRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $booksets = $this->booksetRepository->getAllBooksetList();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $booksets,
            ]);
        }

        return view('admin.booksets.index', compact('booksets'));
    }

    /**
     * Display a form to create bookset.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get board dropdown list
        $boards = $this->booksetRepository->getBoardDropdown();
        $boards->prepend('', '');
        return view('admin.booksets.add',compact('boards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BooksetCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksetCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Create Bookset
            $bookset = $this->booksetRepository->createBookset($request->all());

            return redirect()->route('bookset_edit', $bookset->book_set_id);
            //return redirect()->back()->with('response', $response);
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
        $bookset = $this->booksetRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $bookset,
            ]);
        }

        return view('admin.booksets.show', compact('bookset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookset = $this->booksetRepository->find($id);

        // Get institution board standard By booksetId
        $institutionBoardStandard = $this->booksetRepository->getInstitutionBoardStandardByBooksetId($id);
        $bookset['board_id'] = $institutionBoardStandard->board_id;
        $bookset['standard_id'] = $institutionBoardStandard->standard_id;

        // Get bookset subject By booksetId
        $bookset['subject_id'] = $this->booksetRepository->getBooksetSubjectByBooksetId($id);

        // Get bookset's description
        $bookset['description'] = $this->booksetRepository->getBooksetDescriptionByBooksetId($id);

        // Get selected books By booksetId
        $bookset['book_ids'] = $this->booksetRepository->getSelectedBooksByBooksetId($id);

        // Get bookset's primary image
        $bookset['primary_image'] = $this->booksetRepository->getBoooksetPrimaryImage($id);

        // Get board dropdown list
        $boards = $this->booksetRepository->getBoardDropdown();
        $boards->prepend('', '');

        // Get standard dropdown list
        $standards = $this->booksetRepository->getStandardListByBoardId($institutionBoardStandard->board_id);
        $standards->prepend('', '');

        // Get subject dropdown list
        $subjects = $this->booksetRepository->getSubjectListByBoardStandard($institutionBoardStandard->board_id, $institutionBoardStandard->standard_id);
        $subjects->prepend('', '');

        // Get bookset's books By bookset id
        $products = $this->booksetRepository->findBooks($bookset);

        return view('admin.booksets.edit', compact('bookset', 'boards', 'standards', 'subjects', 'products', 'book_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BooksetUpdateRequest $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(BooksetUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Uplaod primary image
            $image_info = $this->baseController->imageUpload($request, $id);
            if ($image_info) {
                $data['book_set_image_name'] = $image_info['book_set_image_name'];
                $data['book_set_image_path'] = $image_info['book_set_image_path'];
                $this->booksetRepository->updateBooksetImage($data, $id, Config::get('settings.PRIMARY_IMAGE_YES'));
                unset($data['book_set_image_name']);
                unset($data['book_set_image_path']);
            }

            // Store images
            $image_info = $this->baseController->fineUpload($request, $id, $type = 'bookset');
            if ($image_info) {
                $data['book_set_image_name'] = $image_info['book_set_image_name'];
                $data['book_set_image_path'] = $image_info['book_set_image_path'];
            }

            $bookset = $this->booksetRepository->updateBookset($request->all(), $id);
            $response = [
                'message' => 'Bookset updated successfully.',
                'status' => 'success',
                'data'    => $bookset->toArray(),
            ];
            return redirect()->route('bookset_edit', $id)->with('response', $response);
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
        $deleted = $this->booksetRepository->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Bookset deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Bookset deleted.');
    }

    /**
     * Get standard list by ajax call based on board id
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getStandardListByAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'board_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $standard = $this->booksetRepository->getStandardListByBoardId($request->board_id);
            $standard->prepend('', '');
            return response()->json([
                'success' => true,
                'data'  => $standard,
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }

    /**
     * Get standard list by ajax call based on board id
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSubjectListByAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'board_id' => 'required',
            'standard_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $subject = $this->booksetRepository->getSubjectListByBoardStandard($request->board_id, $request->standard_id);
            $subject->prepend('', '');
            return response()->json([
                'success' => true,
                'data'  => $subject,
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }

    /**
     * Get get book list of bookset by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookListByAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bookset_id' => 'required',
            //'vendor_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $products = $this->booksetRepository->getBookListByBooksetId($request->all());
            return response()->json([
                'success' => true,
                'data'  => $products,
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
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
        $image_info = $this->baseController->fineDeleteImage($id, $uuid, $type = 'bookset');
        $image_info = $this->booksetRepository->deleteImageFromDB($id, $uuid);
        return response()->json(['success' => true]);
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
        $images = glob(Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').$id."/*");
        for ($i=0; $i<count($images); $i++) { 
            $file = array();
            $image = $images[$i];
            $info = pathinfo($image);
            $file_name =  basename($image,'.'.$info['extension']);
            $file['name'] = basename($image);
            $file['uuid'] = $file_name;
            $file['thumbnailUrl'] = url(Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').$id.'/' . $file['name']);
            $files[] = $file;
        }
        return response()->json($files);
    }

    /**
     * Display a listing bookset for login vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function getBooksetListForVendor()
    {
        $this->booksetRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $booksets = $this->booksetRepository->getAllBooksetListForVendor();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $booksets,
            ]);
        }

        return view('admin.booksets.list_for_vendor', compact('booksets'));
    }

    /**
     * Store bookset's price by login vendor.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addBooksetPrice(Request $request)
    {
        try {
            $bookset = $this->booksetRepository->addBooksetPriceByVendor($request->all());
            return redirect()->route('booksetlist_forvendor');
            //return redirect()->back()->with('response', $response);
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
     * Display a listing bookset for login Institution
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getBooksetInfoForInstitution($id)
    {
        $booksets = $this->booksetRepository->getBooksetInfoForInstitution($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $booksets,
            ]);
        }

        return view('admin.booksets.list_for_institution', compact('booksets'));
    }

    /**
     * Set Book set preffered based on login institution id
     *
     * @param  int $id
     * @param  int $vendor_id
     * @return \Illuminate\Http\Response
     */
    public function setBooksetPreffered($id, $vendor_id)
    {
        $bookset = $this->booksetRepository->setBooksetPrefferedByInstitution($id, $vendor_id);
        $response = [
            'message' => 'Bookset successfully set as preffered.',
            'status' => 'success'
        ];
        return redirect()->route('booksetlist_forinstitution', $id)->with('response', $response);
    }
}
