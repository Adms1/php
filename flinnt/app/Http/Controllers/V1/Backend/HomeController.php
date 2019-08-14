<?php

namespace App\Http\Controllers\V1\Backend;

use App\Http\Controllers\V1\Backend\BaseController;
use App\Repositories\InstitutionRepository;
use App\Repositories\VendorRepository;
use App\Repositories\OrderRepository;
use App\Repositories\HomeRepository;
use Illuminate\Http\Request;
use App\Entities\Role;
use App\Entities\Bookset;
use App\Entities\Institution;
use App\Entities\BooksetBook;
use App\Entities\Country;
use App\Entities\Order;
use App\Entities\Vendor;
use App\Entities\Status;
use App\Entities\State;
use App\Entities\User;
use Config;
use Session;
use Auth;


class HomeController extends Controller
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
     * @var VendorRepository
     */
    protected $vendorRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var HomeRepository
     */
    protected $homeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseController $baseController,
        VendorRepository $vendorRepository,
        OrderRepository $orderRepository,
        HomeRepository $homeRepository,
        InstitutionRepository $institutionRepository)
    {
        $this->baseController = $baseController;
        $this->institutionRepository = $institutionRepository;
        $this->vendorRepository = $vendorRepository;
        $this->orderRepository = $orderRepository;
        $this->homeRepository = $homeRepository;
        //$this->middleware('auth');
        /*$this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:vendor')->except('logout');
        $this->middleware('guest:institution')->except('logout');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_bookset = 0;
        $top_institutions = [];
        $guard = 'admin';
        $admin_name = 'admin_name';
        $total_vendors = Vendor::where('is_active', 1)->count();
        $total_active_vendors = Vendor::where('is_active', 1)->where('vendor_status_id', 1)->count();
        $total_institutions = Institution::where('is_active', 1)->count();
        $total_active_institutions = Institution::where('is_active', 1)->where('status_id', 1)->count();

        if (Auth::guard('admin')->check()) {
            $total_orders = Order::where('is_active', 1)->count();
            $total_success_count = Order::where('is_active', 1)->where('order_status', 2)->count();
            $last_transections = $this->orderRepository->getLastTransactionSummary();
            $top_vendors = $this->orderRepository->getTopVendors();
            $payment_status_count = $this->orderRepository->getPaymentStatusCount();
            $delivery_status_count = $this->orderRepository->getDeliveryStatusCount();
            $total_revenue = $this->orderRepository->countTotalRevenue();
        }
        
        if (Auth::guard('vendor')->check()) {
            $vendor_id = Auth::guard('vendor')->user()->vendor_id;
            $total_bookset = BooksetBook::where('vendor_id', $vendor_id)->distinct('book_set_id')->count('book_set_id');
            $last_transections = $this->orderRepository->getLastTransactionSummaryForVendor($vendor_id);
            $top_institutions = $this->orderRepository->getTopInstitutions($vendor_id);
            $payment_status_count = $this->orderRepository->getPaymentStatusCountForVendor($vendor_id);
            $delivery_status_count = $this->orderRepository->getDeliveryStatusCountForVendor($vendor_id);
            $total_revenue = $this->orderRepository->countTotalRevenueForVendor($vendor_id);
            $total_orders = $this->orderRepository->countTotalOrderForVendor($vendor_id);
            $total_success_count = $this->orderRepository->countSuccessOrderForVendor($vendor_id);
        }

        if (Auth::guard('institution')->check()) {
            $institution_id = Auth::guard('institution')->user()->institution_id;
            $total_bookset = Bookset::where('institution_id', $institution_id)->count();
            $last_transections = $this->orderRepository->getLastTransactionSummaryForInstitution($institution_id);
            $top_vendors = $this->orderRepository->getTopVendorsForInstitution($institution_id);
            $payment_status_count = $this->orderRepository->getPaymentStatusCountForInstitution($institution_id);
            $delivery_status_count = $this->orderRepository->getDeliveryStatusCountForInstitution($institution_id);
            $total_revenue = $this->orderRepository->countTotalRevenueForInstitution($institution_id);
            $total_orders = $this->orderRepository->countTotalOrderForInstitution($institution_id);
            $total_success_count = $this->orderRepository->countSuccessOrderForInstitution($institution_id);
        }

        return view('admin.home', compact('guard', 'admin_name', 'total_vendors', 'total_active_vendors', 'total_institutions', 'total_active_institutions', 'total_bookset', 'top_vendors', 'last_transections', 'payment_status_count', 'delivery_status_count', 'total_revenue', 'total_orders', 'top_institutions', 'total_success_count'));
    }


    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check() || Auth::guard('vendor')->check() || Auth::guard('institution')->check()) {
            return redirect()->route('home');   
        }

        $roles = Role::pluck('role_name', 'role_id');
        return view('auth.login',  compact('roles'));
    }

    /**
     * Show profile update form based  on login user.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfileForm()
    {
        $countries = Country::pluck('name','country_id');
        $states = State::pluck('name','state_id')->all();
        $status = Status::pluck('status_name','status_id')->all();

        if (Auth::guard('vendor')->check()) {
            $id = Auth::guard('vendor')->user()->vendor_id;
            $vendor = $this->vendorRepository->find($id);
            return view('admin.vendor.profile', compact('countries','states','status','vendor'));
        }

        if (Auth::guard('institution')->check()) {
            $id = Auth::guard('institution')->user()->institution_id;
            $institution = $this->institutionRepository->find($id);
            return view('admin.institutions.profile', compact('countries','states','status','institution'));
        }
        //return redirect()->route('login');
    }

    /**
     * Update user profile
     *
     * @param  Request $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        try {
            if (Auth::guard('vendor')->check()) {
                $id = Auth::guard('vendor')->user()->vendor_id;
                $vendor = $this->vendorRepository->update($request->all(), $id);
                if ($vendor) {
                    $response = [
                        'message' => 'Profile successfully updated.',
                        'status' => 'success',
                        'data'    => $vendor->toArray(),
                    ];
                } else {
                    $response = [
                        'message' => 'Profile not updated.',
                        'status' => 'danger',
                    ];
                }
                return redirect()->route('home')->with('response', $response);
            }

            if (Auth::guard('institution')->check()) {
                $id = Auth::guard('institution')->user()->institution_id;
                $institution = $this->institutionRepository->update($request->all(), $id);

                // Uplaod image
                $image_info = $this->baseController->imageUpload($request, $institution->institution_id);
                if ($image_info) {
                    $data['institution_image'] = $image_info['institution_image'];
                    $this->institutionRepository->updateInstitution($data, $institution->institution_id);
                }

                if ($institution) {
                    $response = [
                        'message' => 'Profile successfully updated.',
                        'status' => 'success',
                        'data'    => $institution->toArray(),
                    ];
                } else {
                    $response = [
                        'message' => 'Profile not updated.',
                        'status' => 'danger',
                    ];
                }
                return redirect()->route('home')->with('response', $response);
            }
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
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        try {
            $credentials = [];
            $credentials['email'] = $request->email;
            $credentials['password'] = $request->password;
            $credentials['is_active'] = Config::get('settings.ACTIVE');

            $response = [
                'message' => 'You are successfully logged in.',
                'status' => 'success',
            ];

            // Logout other user if any already logged in
            $this->homeRepository->userLogout();
            // Get role dropdown list
            $roles = Role::pluck('role_name', 'role_id');
            switch ($request->role_id) {
                case '1':// Admin
                    $credentials['status_id'] = Config::get('settings.STATUS_ACTIVE');
                    if (Auth::guard('admin')->attempt($credentials)) {
                        return redirect()->route('home')->with('response', $response);
                    }
                    break;

                case '2':// Vendor
                    $credentials['vendor_status_id'] = Config::get('settings.STATUS_ACTIVE');
                    if (Auth::guard('vendor')->attempt($credentials)) {
                        return redirect()->route('home')->with('response', $response);
                    }
                    break;

                case '3':// Institution
                    $credentials['status_id'] = Config::get('settings.STATUS_ACTIVE');
                    if (Auth::guard('institution')->attempt($credentials)) {
                        return redirect()->route('home')->with('response', $response);
                    }
                    break;

                default:// User
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, Config::get('settings.API_URL'));
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(['username' => $request->email, 'password' => md5($request->password)]));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $server_output = json_decode(curl_exec($curl));
                    curl_close ($curl);
                    if ($server_output->status == 1) {
                        $user = User::firstOrCreate(['user_id' => $server_output->data->user_id, 'user_name' => $server_output->data->firstname." ".$server_output->data->lastname, 'email' => $server_output->data->user_login]);
                        return redirect()->route('front_home')->with('response', $response);
                    }
                    break;
            }

            $response = [
                'message' => 'Logged in failed, please check your credentials.',
                'status' => 'danger',
            ];
            return redirect()->route('login')->with('response', $response);
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
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('vendor')->logout();
        Auth::guard('institution')->logout();

        Session::flush();

        $response = [
            'message' => 'You are successfully logged out.',
            'status' => 'success',
        ];   

        return redirect()->route('login')->with('response', $response);
    }

    /**
     * Get date wise total price by ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function getTransactionByAjax()
    {
        $transactions = $this->orderRepository->getTransactionByAjax();
        if ($transactions) {
            return response()->json([
                'success' => true,
                'data'  => $transactions,
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data'  => [],
            ]);
        }
    }
}
