<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;

/*use App\Http\Requests;*/
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Controllers\V1\Backend\BaseController;
use App\Http\Requests\InstitutionCreateRequest;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use App\Entities\Country;
use App\Entities\State;
use App\Entities\Status;
use App\Entities\Board;
use App\Entities\Standard;
use App\Entities\Subject;
use Hash;

/**
 * Class InstitutionsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class InstitutionsController extends Controller
{
    /**
     * @var BaseController
     */
    protected $baseController;

    /**
     * @var InstitutionRepository
     */
    protected $institutionRepository;

    /**
     * @var InstitutionValidator
     */
    protected $validator;

    /**
     * InstitutionsController constructor.
     *
     * @param InstitutionRepository $institutionRepository
     * @param InstitutionValidator $validator
     */
    public function __construct(
        BaseController $baseController,
        InstitutionRepository $institutionRepository, 
        InstitutionValidator $validator)
    {
        $this->baseController = $baseController;
        $this->institutionRepository = $institutionRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->institutionRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $institutions = $this->institutionRepository->getInstitutionList();
        return view('admin.institutions.index', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get countries dropdown list
        $countries = Country::pluck('name','country_id');

        // Get states dropdown list
        $states = State::pluck('name','state_id')->all();

        // Get status dropdown list
        $status = Status::pluck('status_name','status_id')->all();
        return view('admin.institutions.add', compact('countries','states','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->all();

            //Set Default password
            $data['password'] = Hash::make('123456');
            $institution = $this->institutionRepository->create($data);
            $institution_role = $this->institutionRepository->addInstitutionRole($institution);

            // Uplaod image
            $image_info = $this->baseController->imageUpload($request, $institution->institution_id);
            if ($image_info) {
                $data['institution_image'] = $image_info['institution_image'];
                $this->institutionRepository->updateInstitution($data, $institution->institution_id);
            }

            // Insert new institution
            if ($institution) {
                $response = [
                    'message' => 'Institution successfully created.',
                    'status' => 'success',
                    'data'    => $institution->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Institution not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('institution_list')->with('response', $response);

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
        $institution = $this->institutionRepository->find($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $institution,
            ]);
        }

        return view('admin.institutions.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get countries dropdown list
        $countries = Country::pluck('name','country_id');

        // Get states dropdown list
        $states = State::pluck('name','state_id')->all();

        // Get status dropdown list
        $status = Status::pluck('status_name','status_id')->all();

        $institution = $this->institutionRepository->find($id);
        return view('admin.institutions.edit', compact('countries','states','institution', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update institution
            $institution = $this->institutionRepository->update($request->all(), $id);

            // Uplaod image
            $image_info = $this->baseController->imageUpload($request, $institution->institution_id);
            if ($image_info) {
                $data['institution_image'] = $image_info['institution_image'];
                $this->institutionRepository->updateInstitution($data, $institution->institution_id);
            }

            if ($institution) {
                $response = [
                    'message' => 'Institution successfully updated.',
                    'status' => 'success',
                    'data'    => $institution->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Institution not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('institution_list')->with('response', $response);
            
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
        $deleted = $this->institutionRepository->deleteInstitution($id);
        if ($deleted) {
            $response = [
                'message' => 'Institution successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Institution not deleted.',
                'status' => 'danger',
            ];
        }

        return redirect()->back()->with('response', $response);
    }

    /**
     * View page to assign standards with subjects in board based on login institution
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBoardStandardForm(Request $request)
    {
        // Get standard dropdown list
        $class = Standard::where('is_active', '1')->pluck('standard_name', 'standard_id');

        // Get board dropdown list
        $board = Board::where('is_active', '1')->pluck('board_name', 'board_id');
        $board->prepend('', '');

        // Get subject dropdown list
        $subject = Subject::where('is_active', '1')->pluck('subject_name', 'subject_id');

        return view('admin.institutions.assignBoardStandard', compact('class', 'board', 'subject'));
    }

    /**
     * Store standards with subjects and boards based on login institution id
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignBoardStandard(Request $request)
    {
        $data = $request->all();
        $assign = $this->institutionRepository->assignBoardStandard($data);
        if ($assign) {
            $response = [
                'message' => 'Standards and subjects are successfully assigned to board.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Standards and subjects are not assigned.',
                'status' => 'danger',
            ];
        }
        return redirect()->route('institution_boardstandard_list')->with('response', $response);
    }

    /**
     * View page to show list of standards with subjects in board based on login institution
     *
     * @return \Illuminate\Http\Response
     */
    public function getBoardStandardList()
    {
        // Get standard list
        $assign_list = $this->institutionRepository->getBoardStandardList();
        foreach ($assign_list as $key => $assign) {
            $assign->subject_name = $this->institutionRepository->getBoardStandardSubjectList($assign->board_id, $assign->standard_id);
        }
        /*echo "<pre>";
        print_r($assign_list);
        die;*/
        /*$board = "";
        $assign_data = new class()
        foreach ($assign_list as $key => $assign) {
            $new_board = $assign->board_id;
            if ($board != $new_board) {
                $assign_data->board_id = $assign->board_id;
                $assign_data->board_name = $assign->board_name;
                $standard_ids[] = $assign->standard_name;
                $assign_data->standard_id = $standard_ids;
                $board = $assign->board_id;
            } else {
                $standard_ids[] = $assign->standard_name;
            }
        }
        die;*/
        return view('admin.institutions.assignBoardStandardList', compact('assign_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $board_id
     * @param  int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function getBoardStandardEditForm($board_id, $standard_id)
    {
        // Get standard dropdown list
        $class = Standard::where('is_active', '1')->pluck('standard_name', 'standard_id');

        // Get board dropdown list
        $board = Board::where('is_active', '1')->pluck('board_name', 'board_id');

        // Get subject dropdown list
        $subject = Subject::where('is_active', '1')->pluck('subject_name', 'subject_id');

        $assign_subjects = $this->institutionRepository->getBoardStandardSubjectId($board_id, $standard_id);
        return view('admin.institutions.assignBoardStandardEdit', compact('class', 'board', 'board_id', 'standard_id', 'assign_subjects', 'subject'));
    }

    /**
     * Store subjects in standards and boards based on login institution id
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $board_id
     * @param  int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function updateBoardStandard(Request $request, $board_id, $standard_id)
    {
        $data = $request->all();
        $assign = $this->institutionRepository->updateBoardStandard($data, $board_id, $standard_id);
        if ($assign) {
            $response = [
                'message' => 'Subjects are successfully assigned to board.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Subjects are not assigned.',
                'status' => 'danger',
            ];
        }
        return redirect()->route('institution_boardstandard_list')->with('response', $response);
    }

    /**
     * Change status of standard.
     *
     * @param  int $id
     * @param  int $status
     * @return \Illuminate\Http\Response
     */
    public function changestatus($id, $status)
    {
        $deleted = $this->institutionRepository->changeBoardStandardStatus($id, $status);
        if ($deleted) {
            $response = [
                'message' => 'Standard status successfully updated.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Standard status not updated.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }
}
