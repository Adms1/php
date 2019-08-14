<?php

namespace App\Http\Controllers\V1\Backend;

/*use Illuminate\Http\Request;

use App\Http\Requests;*/
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SubjectCreateRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Repositories\SubjectRepository;
use App\Validators\SubjectValidator;

/**
 * Class SubjectsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class SubjectsController extends Controller
{
    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    /**
     * @var SubjectValidator
     */
    protected $validator;

    /**
     * SubjectsController constructor.
     *
     * @param SubjectRepository $subjectRepository
     * @param SubjectValidator $validator
     */
    public function __construct(SubjectRepository $subjectRepository, SubjectValidator $validator)
    {
        $this->subjectRepository = $subjectRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->subjectRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $subjects = $this->subjectRepository->getSubjectList();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $subjects,
            ]);
        }

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubjectCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Create Subject
            $subject = $this->subjectRepository->create($request->all());
            if ($subject) {
                $response = [
                    'message' => 'Subject successfully created.',
                    'status' => 'success',
                    'data'    => $subject->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Subject not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('subject_list')->with('response', $response);

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
        $subject = $this->subjectRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $subject,
            ]);
        }

        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->subjectRepository->find($id);
        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubjectUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update Subject
            $subject = $this->subjectRepository->update($request->all(), $id);
            if ($subject) {
                $response = [
                    'message' => 'Subject successfully updated.',
                    'status' => 'success',
                    'data'    => $subject->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Subject not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('subject_list')->with('response', $response);
            
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
        $deleted = $this->subjectRepository->deleteSubject($id);
        if ($deleted) {
            $response = [
                'message' => 'Subject successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Subject not deleted.',
                'status' => 'danger',
            ];
        }

        return redirect()->back()->with('message', 'Subject deleted.');
    }
}
