<?php

namespace App\Http\Controllers\V1\Backend;

/*use Illuminate\Http\Request;

use App\Http\Requests;*/
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BoardCreateRequest;
use App\Http\Requests\BoardUpdateRequest;
use App\Repositories\BoardRepository;
use App\Validators\BoardValidator;

/**
 * Class BoardsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class BoardsController extends Controller
{
    /**
     * @var BoardRepository
     */
    protected $boardRepository;

    /**
     * @var BoardValidator
     */
    protected $validator;

    /**
     * BoardsController constructor.
     *
     * @param BoardRepository $boardRepository
     * @param BoardValidator $validator
     */
    public function __construct(BoardRepository $boardRepository, BoardValidator $validator)
    {
        $this->boardRepository = $boardRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->boardRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $boards = $this->boardRepository->getBoardList();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $boards,
            ]);
        }

        return view('admin.boards.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.boards.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BoardCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Insert new board
            $board = $this->boardRepository->create($request->all());
            if ($board) {
                $response = [
                    'message' => 'Board successfully created.',
                    'status' => 'success',
                    'data'    => $board->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Board not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('board_list')->with('response', $response);
            
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
        $board = $this->boardRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $board,
            ]);
        }

        return view('admin.boards.show', compact('board'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $board = $this->boardRepository->find($id);
        return view('admin.boards.edit', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BoardUpdateRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(BoardUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update Board
            $board = $this->boardRepository->update($request->all(), $id);
            if ($board) {
                $response = [
                    'message' => 'Board successfully updated.',
                    'status' => 'success',
                    'data'    => $board->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Board not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('board_list')->with('response', $response);
            
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
        $deleted = $this->boardRepository->deleteBoard($id);
        if ($deleted) {
            $response = [
                'message' => 'Board successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Board not deleted.',
                'status' => 'danger',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
