<?php

namespace App\Http\Controllers\V1\Backend;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StandardCreateRequest;
use App\Http\Requests\StandardUpdateRequest;
use App\Repositories\StandardRepository;
use App\Validators\StandardValidator;

/**
 * Class StandardsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class StandardsController extends Controller
{
    /**
     * @var StandardRepository
     */
    protected $standardRepository;

    /**
     * @var StandardValidator
     */
    protected $validator;

    /**
     * StandardsController constructor.
     *
     * @param StandardRepository $standardRepository
     * @param StandardValidator $validator
     */
    public function __construct(StandardRepository $standardRepository, StandardValidator $validator)
    {
        $this->standardRepository = $standardRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->standardRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $standards = $this->standardRepository->getStandardList();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $standards,
            ]);
        }

        return view('admin.standards.index', compact('standards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.standards.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StandardCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StandardCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Insert new standard
            $standard = $this->standardRepository->create($request->all());
            if ($standard) {
                $response = [
                    'message' => 'Standard successfully created.',
                    'status' => 'success',
                    'data'    => $standard->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Standard not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('standard_list')->with('response', $response);
            
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
        $standard = $this->standardRepository->find($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $standard,
            ]);
        }

        return view('admin.standards.show', compact('standard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $standard = $this->standardRepository->find($id);
        return view('admin.standards.edit', compact('standard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StandardUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StandardUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update Standard
            $standard = $this->standardRepository->update($request->all(), $id);
            if ($standard) {
                $response = [
                    'message' => 'Standard successfully updated.',
                    'status' => 'success',
                    'data'    => $standard->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Standard not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('standard_list')->with('response', $response);
            
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
        $deleted = $this->standardRepository->deleteStandard($id);
        if ($deleted) {
            $response = [
                'message' => 'Standard successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Standard not deleted.',
                'status' => 'danger',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
