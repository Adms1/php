<?php

namespace App\Http\Controllers\V1\Backend;

/*use Illuminate\Http\Request;*/

/*use App\Http\Requests;*/
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Repositories\AuthorRepository;
use App\Validators\AuthorValidator;
//use App\Entities\Author;

/**
 * Class AuthorsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class AuthorsController extends Controller
{
    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * @var AuthorValidator
     */
    protected $validator;

    /**
     * AuthorsController constructor.
     *
     * @param AuthorRepository $authorRepository
     * @param AuthorValidator $validator
     */
    public function __construct(AuthorRepository $authorRepository, AuthorValidator $validator)
    {
        $this->authorRepository = $authorRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        //$authors = Author::where('is_active', '1')->get();
        $authors = $this->authorRepository->getAuthorList();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $authors,
            ]);
        }

        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AuthorCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->all();

            // Insert new Author
            $author = $this->authorRepository->createAuthor($data);
            if ($author) {
                $response = [
                    'message' => 'Author successfully created.',
                    'status' => 'success',
                    'data'    => $author->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Author not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('author_list')->with('response', $response);

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
        $author = $this->authorRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $author,
            ]);
        }

        return view('admin.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = $this->authorRepository->find($id);
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AuthorUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $data = $request->all();

            // Update author
            $author = $this->authorRepository->updateAuthor($data, $id);
            if ($author) {
                $response = [
                    'message' => 'Author successfully updated.',
                    'status' => 'success',
                    'data'    => $author->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Author not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('author_list')->with('response', $response);

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
        $deleted = $this->authorRepository->deleteAuthor($id);
        if ($deleted) {
            $response = [
                'message' => 'Author successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Author not deleted.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }


    /**
     * Add author name by ajax call
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authorAjaxStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_name' => 'required|max:255|unique:author',
        ]);
        
        if ($validator->passes()) {
            $author = $this->authorRepository->create($request->all());
            return response()->json([
                'success' => true,
                'data'  => $author->toArray(),
            ]);
        }

        return response()->json([
            'error'   => true,
            'message' => $validator->errors()
        ]);
    }
}
