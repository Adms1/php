<?php

namespace App\Http\Controllers\V1\Backend;

/*use App\Http\Requests;*/
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VendorCreateRequest;
use App\Http\Requests\VendorUpdateRequest;
use App\Repositories\VendorRepository;
use App\Validators\VendorValidator;
use App\Entities\InstitutionVendor;
use App\Entities\Country;
use App\Entities\Status;
use App\Entities\State;
use Hash;
//use Auth;

/**
 * Class VendorsController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class VendorsController extends Controller
{
    /**
     * @var VendorRepository
     */
    protected $vendorRepository;

    /**
     * @var VendorValidator
     */
    protected $validator;

    /**
     * VendorsController constructor.
     *
     * @param VendorRepository $vendorRepository
     * @param VendorValidator $validator
     */
    public function __construct(VendorRepository $vendorRepository, VendorValidator $validator)
    {
        $this->vendorRepository = $vendorRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->vendorRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $vendors = $this->vendorRepository->getVendorList();
        return view('admin.vendor.index', compact('vendors'));
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
        $status = Status::where('is_active', '1')->pluck('status_name','status_id')->all();
        return view('admin.vendor.add',compact('countries','states','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VendorCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->all();

            //Set Default password
            $data['password'] = Hash::make('123456');
            // Create new vendor
            $vendor = $this->vendorRepository->create($data);
            $vendor_role = $this->vendorRepository->addVendorRole($vendor);
            if ($vendor) {
                $response = [
                    'message' => 'Vendor successfully created.',
                    'status' => 'success',
                    'data'    => $vendor->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Vendor not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('vendor_list')->with('response', $response);
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
        // Get countries dropdown list
        $countries = Country::pluck('name','country_id');

        // Get states dropdown list
        $states = State::pluck('name','state_id')->all();

        // Get status dropdown list
        $status = Status::where('is_active', '1')->pluck('status_name','status_id')->all();
    
        $vendor = $this->vendorRepository->find($id);
        return view('admin.vendor.edit', compact('countries','states','status','vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VendorUpdateRequest $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update vendor
            $vendor = $this->vendorRepository->update($request->all(), $id);
            if ($vendor) {
                $response = [
                    'message' => 'Vendor successfully updated.',
                    'status' => 'success',
                    'data'    => $vendor->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Vendor not updated.',
                    'status' => 'danger',
                ];
            }

            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->route('vendor_list')->with('response', $response);
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
        $vendor = $this->vendorRepository->getVendorByID($id);
        return view('admin.vendor.view', compact('vendor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->vendorRepository->deleteVendor($id);
        if ($deleted) {
            $response = [
                'message' => 'Vendor successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Vendor not deleted.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }

    /**
     * Display list of vendors which are approved by flinnt admin
     *
     * @return \Illuminate\Http\Response
     */
    public function getApprovedVendorForm()
    {
        $this->vendorRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        // Get selected vendors based on login institution id
        $selected_vendors = $this->vendorRepository->getSelectedVendorsByInstitution();

        // Get all flinnt admin's approved vendors
        $vendors = $this->vendorRepository->getApprovedVendorList();

        return view('admin.vendor.approved_list', compact('vendors', 'selected_vendors'));
    }

    /**
     * Display list of vendors which are approved by flinnt admin
     *
     * @return \Illuminate\Http\Response
     */
    public function selectApprovedVendor(Request $request)
    {
        $this->vendorRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $data = $request->all();

        $vendors = $this->vendorRepository->storeSelectedVendor($data['vendor_ids']);
        if ($vendors) {
            $response = [
                'message' => 'Vendor successfully added to your vendor list.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Vendor not deleted added to your vendor list.',
                'status' => 'danger',
            ];
        }
        return redirect()->back()->with('response', $response);
    }
}
