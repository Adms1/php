<?php

namespace App\Http\Controllers\V1\Backend;

/*use App\Http\Requests;*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AttributeCreateRequest;
use App\Http\Requests\AttributeUpdateRequest;
use App\Repositories\AttributeRepository;
use App\Validators\AttributeValidator;

/**
 * Class AttributesController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class AttributesController extends Controller
{
    /**
     * @var AttributeRepository
     */
    protected $attributeRepository;

    /**
     * @var AttributeValidator
     */
    protected $validator;

    /**
     * AttributesController constructor.
     *
     * @param AttributeRepository $attributeRepository
     * @param AttributeValidator $validator
     */
    public function __construct(AttributeRepository $attributeRepository, AttributeValidator $validator)
    {
        $this->attributeRepository = $attributeRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->attributeRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $attributes = $this->attributeRepository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $attributes,
            ]);
        }

        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AttributeCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Create attribute
            $attribute = $this->attributeRepository->create($request->all());
            if ($attribute) {
                $response = [
                    'message' => 'Attribute successfully created.',
                    'status' => 'success',
                    'data'    => $attribute->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Attribute not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('attribute_list')->with('response', $response);

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
        $attribute = $this->attributeRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $attribute,
            ]);
        }

        return view('admin.attributes.show', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = $this->attributeRepository->find($id);
        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AttributeUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update attribute
            $attribute = $this->attributeRepository->update($request->all(), $id);
            if ($attribute) {
                $response = [
                    'message' => 'Attribute successfully updated.',
                    'status' => 'success',
                    'data'    => $attribute->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Attribute not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('attribute_list')->with('response', $response);

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->attributeRepository->deleteAttribute($id);
        if ($deleted) {
            $response = [
                'message' => 'Attribute successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Attribute not deleted.',
                'status' => 'danger',
            ];
        }

        return redirect()->back()->with('response', $response);
    }

    /**
     * Add attribute name by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function attributeAjaxStore(Request $request, $product_id)
    {
        $validator = Validator::make($request->all(), [
            'attribute_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $attribute = $this->attributeRepository->addAttributeToProduct($request->all(), $product_id);
            return response()->json([
                'success' => true,
                'data'  => $attribute->toArray(),
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }

    /**
     * Update attribute name by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function attributeAjaxUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_attribute_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $attribute = $this->attributeRepository->updateAttributeValueOfProduct($request->all());
            return response()->json([
                'success' => true,
                'data'  => $attribute->toArray(),
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }

    /**
     * Delete attribute by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function attributeAjaxDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_attribute_id' => 'required',
        ]);
        
        if ($validator->passes()) {
            $attribute = $this->attributeRepository->deleteAttributeOfProduct($request->all());
            return response()->json([
                'success' => true,
                'data'  => $attribute,
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function specificationCreate()
    {
        return view('admin.attributes.specification_add');
    }

    /**
     * Show the List of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function specificationStore()
    {
        return view('admin.attributes.specification_list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsAttributeCreate()
    {
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

        return view('admin.attributes.product_attr_add',compact('sp_attributes', 'pr_attributes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsAttributeStore()
    {
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

        return view('admin.attributes.product_attr_list',compact('sp_attributes', 'pr_attributes'));
    }
}
