<?php

namespace App\Http\Controllers\V1\Backend;

/*use Illuminate\Http\Request;*/

/*use App\Http\Requests;*/
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PublisherCreateRequest;
use App\Http\Requests\PublisherUpdateRequest;
use App\Repositories\PublisherRepository;
use App\Validators\PublisherValidator;
//use App\Entities\Publisher;

/**
 * Class PublishersController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class PublishersController extends Controller
{
    /**
     * @var PublisherRepository
     */
    protected $publisherRepository;

    /**
     * @var PublisherValidator
     */
    protected $validator;

    /**
     * PublishersController constructor.
     *
     * @param PublisherRepository $publisherRepository
     * @param PublisherValidator $validator
     */
    public function __construct(PublisherRepository $publisherRepository, PublisherValidator $validator)
    {
        $this->publisherRepository = $publisherRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->publisherRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        //$publishers = Publisher::where('is_active', '1')->get();
        $publishers = $this->publisherRepository->getPublisherList();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $publishers,
            ]);
        }

        return view('admin.publishers.index', compact('publishers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publishers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PublisherCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublisherCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->all();
            
            // Create New Publisher
            $publisher = $this->publisherRepository->createPublisher($data);
            if ($publisher) {
                $response = [
                    'message' => 'Publisher successfully created.',
                    'status' => 'success',
                    'data'    => $publisher->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Publisher not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('publisher_list')->with('response', $response);

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
        $publisher = $this->publisherRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $publisher,
            ]);
        }

        return view('admin.publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publisher = $this->publisherRepository->find($id);
        return view('admin.publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PublisherUpdateRequest $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublisherUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $data = $request->all();

            // Update publisher
            $publisher = $this->publisherRepository->updatePublisher($data, $id);
            if ($publisher) {
                $response = [
                    'message' => 'Publisher successfully updated.',
                    'status' => 'success',
                    'data'    => $publisher->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Publisher not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('publisher_list')->with('response', $response);
            
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
        $deleted = $this->publisherRepository->deletePublisher($id);
        if ($deleted) {
            $response = [
                'message' => 'Publisher successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Publisher not deleted.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }

    /**
     * Add publisher name by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function publisherAjaxStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'publisher_name' => 'required|max:255|unique:publisher',
        ]);
        
        if ($validator->passes()) {
            $publisher = $this->publisherRepository->create($request->all());
            return response()->json([
                'success' => true,
                'data'  => $publisher->toArray(),
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }
}