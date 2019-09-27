<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LoginRepository;
use App\Repositories\TutorRepository;
use Validator;
use Session;
use Auth;
use Lang;
use Hash;

class LoginController extends Controller
{

    /**
     * @var LoginRepository
     */
    protected $loginRepository;

    /**
     * @var TutorRepository
     */
    protected $tutorRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        TutorRepository $tutorRepository,
        LoginRepository $loginRepository
    ){
        $this->loginRepository = $loginRepository;
        $this->tutorRepository = $tutorRepository;
    }

    /**
     * Display a login form for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLoginForm()
    {
        $title = Lang::get('admin.ca_login');
        return view('admin.login', compact('title'));
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Adminlogin(Request $request)
    {
        // Logout if any session exist
        Auth::logout();
        $request->session()->flush();
        Session::flush();

        // Do login
        if (Auth::guard('admin')->attempt([
            'UserEmail' => $request->UserEmail,
            'password' => $request->UserPassword
        ])) {
            return redirect()->route('home');
        }

        return redirect()->route('admin_login')->with('error', Lang::get('auth.failed'));
    }

    /**
     * Display a login form for tutor
     *
     * @return \Illuminate\Http\Response
     */
    public function showTutorLoginForm()
    {
        $title = Lang::get('admin.ca_login');
        return view('tutor.login', compact('title'));
    }

    /**
     * Store a newly created tutor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Tutorlogin(Request $request)
    {
        // Logout if any session exist
        Auth::logout();
        $request->session()->flush();
        Session::flush();

        // Do login
        if (Auth::guard('tutor')->attempt([
            'TutorEmail' => $request->TutorEmail, 
            'password' => $request->TutorPassword,
            'StatusID' => 1
        ])) {
            return redirect()->route('home');
        }
        
        return redirect()->route('tutor_login')->with('error', Lang::get('auth.failed'));
    }

    /**
     * logout tutor/admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        Session::flush();
        return redirect()->intended('/')->with('success', Lang::get('auth.logout'));
    }

    /**
     * Display Forgot password form
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgotPasswordForm()
    {
        $title = Lang::get('admin.ca_forgot_pass');
        return view('tutor.forgot_password', compact('title'));
    }

    /**
     * Check mobile is register then send otp
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkMobileRegister(Request $request)
    {
        $data = $request->all();
        $title = Lang::get('admin.ca_forgot_pass');
        // Check mobile number exist or not
        $tutor = $this->tutorRepository->checkUserExistByMobile($data['TutorPhoneNumber']);
        if (isset($tutor->TutorPhoneNumber)) {
            //Get User info and send otp
            Session::put('tutor_id', $tutor->TutorID);
            Session::put('mobile', $tutor->TutorPhoneNumber);
            $this->tutorRepository->sendOtp($tutor->TutorPhoneNumber);
            return view('tutor.forgot_otp', compact('tutor', 'title'));
        } else {
            return redirect()->route('forgot_password')->with('error', Lang::get('passwords.mobile_not_exist'));
        }
    }

    /**
     * Display set password form after forgot password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSetPasswordForm()
    {
        $title = Lang::get('admin.ca_reset_password');
        return view('tutor.set_password', compact('title'));
    }

    /**
     * Set password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setPassword(Request $request)
    {
        //Get User info by id and then create new password
        $user = $this->tutorRepository->edit(Session::get('tutor_id'));
        if ($user) {
            $user->TutorPassword = Hash::make($request->get('TutorPassword'));
            $user->save();
            return redirect()->route('tutor_login')->with('success', Lang::get('passwords.reset'));
        }
        // return redirect()->back()->withErrors('Current password is incorrect');
    }

    /**
     * Display Reset/Change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        $title = Lang::get('admin.ca_change_password');
        if (Auth::guard('admin')->check()) { // For Admin
            $user = Auth::guard('admin')->getUser();    
        }

        if (Auth::guard('tutor')->check()) { // For Tutor
            $user = Auth::guard('tutor')->getUser();    
        }

        return view('auth.change_password', compact('user', 'title'));
    }

    /**
     * Reset/Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        if (Auth::guard('admin')->check()) { // For Admin
            $user = Auth::guard('admin')->user();
            if (Hash::check($request->get('current_password'), $user->UserPassword)) {
                $user->UserPassword = Hash::make($request->get('new_password'));
                $user->save();
                return redirect()->route('change_password')->with('success', Lang::get('passwords.reset'));
            }
        }

        if (Auth::guard('tutor')->check()) { // For Tutor
            $user = Auth::guard('tutor')->user();
            if (Hash::check($request->get('current_password'), $user->TutorPassword)) {
                $user->TutorPassword = Hash::make($request->get('new_password'));
                $user->save();
                return redirect()->route('change_password')->with('success', Lang::get('passwords.reset'));
            }
        }
        return redirect()->back()->withErrors('Current password is incorrect');
    }
}