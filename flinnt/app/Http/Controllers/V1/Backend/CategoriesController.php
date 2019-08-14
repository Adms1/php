<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\V1\Backend\BaseController;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Validators\CategoryValidator;
use Config;

/**
 * Class CategoriesController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var BaseController
     */
    protected $baseController;

    /**
     * @var CategoryValidator
     */
    protected $validator;

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $categoryRepository
     * @param CategoryValidator $validator
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        BaseController $baseController,
        CategoryValidator $validator)
    {
        $this->categoryRepository = $categoryRepository;
        $this->baseController = $baseController;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->categoryRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        
        // Get All Categories 
        $categories = $this->categoryRepository->getCategoryList();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $categories,
            ]);
        }
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Display a form to create category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->categoryRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        // Get Categories Dropdown list
        $categories = $this->categoryRepository->getCategoryDropdownList();
        $categories[0] = 'Root Category';

        return view('admin.categories.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->all();

            // Change 'On/Off' value to '1/0'
            if (isset($data['is_active'])) {
                $data['is_active'] = $this->categoryRepository->setCheckboxValue($data['is_active']);
            } else {
                $data['is_active'] = 0;
            }

            // Insert new category
            $category = $this->categoryRepository->createCategory($data);

            // Uplaod image
            $image_info = $this->baseController->imageUpload($request, $category->category_id);
            if ($image_info) {
                $data['category_image'] = $image_info['category_image'];
                $this->categoryRepository->updateCategory($data, $category->category_id);
            }

            if ($category) {
                $response = [
                    'message' => 'Category successfully created.',
                    'status' => 'success',
                    'data'    => $category->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Category not created.',
                    'status' => 'danger',
                ];
            }

            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->route('category_list')->with('response', $response);
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get category info by bridge category's primary id
        $category = $this->categoryRepository->getBridgeDataById($id);
        if ($category->parent_category_id != 0) {
            // Get category info by bridge category's category id
            $bridge_data = $this->categoryRepository->getBridgeDataByCategoryId($category->parent_category_id);
            if ($bridge_data) {
                $category->parent_category_id = $bridge_data->category_tree_id;
            }
        }
        // Get Dropdown List of bridge categories
        $categories = $this->categoryRepository->getCategoryDropdownList();
        $categories[0] = 'Root Category';
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $data = $request->all();

            // Change 'On/Off' value to '1/0'
            if (isset($data['is_active'])) {
                $data['is_active'] = $this->categoryRepository->setCheckboxValue($data['is_active']);
            } else {
                $data['is_active'] = 0;
            }

            // Insert new category
            $bridge_data = $this->categoryRepository->getBridgeDataById($id);
            $category = $this->categoryRepository->updateCategory($data, $bridge_data->child_category_id);

            // Uplaod image
            $image_info = $this->baseController->imageUpload($request, $category->category_id);
            if ($image_info) {
                $data['category_image'] = $image_info['category_image'];
                $this->categoryRepository->updateCategory($data, $category->category_id);
            }

            if ($category) {
                $response = [
                    'message' => 'Category successfully updated.',
                    'status' => 'success',
                    'data'    => $category->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Category not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('category_list')->with('response', $response);
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
        $deleted = $this->categoryRepository->deleteCategory($id);
        if ($deleted) {
            $response = [
                'message' => 'Category successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Category not deleted.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }

    /**
     * Change Status of category.
     *
     * @param  int $id
     * @param  int $status
     * @return \Illuminate\Http\Response
     */
    public function changestatus($id, $status)
    {
        $deleted = $this->categoryRepository->changeCategoryStatus($id, $status);
        if ($deleted) {
            $response = [
                'message' => 'Category status successfully updated.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Category status not updated.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }

}
