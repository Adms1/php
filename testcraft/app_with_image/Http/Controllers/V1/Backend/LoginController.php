<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LoginRepository;
use App\Repositories\TutorRepository;
use Auth;
use Lang;
use Session;
use Hash;
use Validator;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLoginForm()
    {
        $title = Lang::get('admin.ca_login');
        return view('admin.login', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Adminlogin(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        Session::flush();

        if (Auth::guard('admin')->attempt([
            'UserEmail' => $request->UserEmail,
            'password' => $request->UserPassword
        ])) {
            return redirect()->route('home')->with('success', Lang::get('auth.success'));
        }

        // $response = $this->loginRepository->doLogin($data);
        
        // if ($response) {
        //     $user = $response[0];
        //     Session::put('user', $user);
        //     return redirect()->route('home')->with('success', Lang::get('auth.success'));
        // }

        return redirect()->route('admin_login')->with('error', Lang::get('auth.failed'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTutorLoginForm()
    {
        $title = Lang::get('admin.ca_login');
        return view('tutor.login', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Tutorlogin(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        Session::flush();

        if (Auth::guard('tutor')->attempt([
            'TutorEmail' => $request->TutorEmail, 
            'password' => $request->TutorPassword,
            'StatusID' => 1
        ])) {
            return redirect()->route('home')->with('success', Lang::get('auth.success'));
        }
        
        // $response = $this->loginRepository->doTutorLogin($data);

        // if ($response) {
        //     $user = $response[0];
        //     Session::put('user', $user);
        //     return redirect()->route('home')->with('success', Lang::get('auth.success'));
        // }

        return redirect()->route('tutor_login')->with('error', Lang::get('auth.failed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function login(Request $request)
    // {
    //     $data = $request->all();
    //     $response = $this->loginRepository->doLogin($data);
 
    //     if ($response) {
    //         $user = $response[0];
    //         Session::put('user', $user);
    //         return redirect()->route('home')->with('success', Lang::get('auth.success'));
    //     }

    //     return redirect()->route('login')->with('error', Lang::get('auth.failed'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * Forgot Password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForgotPasswordForm()
    {
        $title = Lang::get('admin.ca_forgot_pass');
        return view('tutor.forgot_password', compact('title'));
    }

    /**
     * check mobile is register then send otp
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkMobileRegister(Request $request)
    {
        $data = $request->all();
        $title = Lang::get('admin.ca_forgot_pass');
        $tutor = $this->tutorRepository->checkUserExistByMobile($data['TutorPhoneNumber']);
        if (isset($tutor->TutorPhoneNumber)) {
            Session::put('tutor_id', $tutor->TutorID);
            Session::put('mobile', $tutor->TutorPhoneNumber);
            $this->tutorRepository->sendOtp($tutor->TutorPhoneNumber);
            return view('tutor.forgot_otp', compact('tutor', 'title'));
        } else {
            return redirect()->route('forgot_password')->with('error', Lang::get('passwords.mobile_not_exist'));
        }
    }

    /**
     * Change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSetPasswordForm()
    {
        $title = Lang::get('admin.ca_reset_password');
        return view('tutor.set_password', compact('title'));
    }

    /**
     * Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function setPassword(Request $request)
    {
        $user = $this->tutorRepository->edit(Session::get('tutor_id'));
        if ($user) {
            $user->TutorPassword = Hash::make($request->get('TutorPassword'));
            $user->save();
            return redirect()->route('tutor_login')->with('success', Lang::get('passwords.reset'));
        }
        // return redirect()->back()->withErrors('Current password is incorrect');
    }

    /**
     * Change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        $title = Lang::get('admin.ca_change_password');
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->getUser();    
        }

        if (Auth::guard('tutor')->check()) {
            $user = Auth::guard('tutor')->getUser();    
        }

        return view('auth.change_password', compact('user', 'title'));
    }

    /**
     * Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            if (Hash::check($request->get('current_password'), $user->UserPassword)) {
                $user->UserPassword = Hash::make($request->get('new_password'));
                $user->save();
                return redirect()->route('change_password')->with('success', Lang::get('passwords.reset'));
            }
        }

        if (Auth::guard('tutor')->check()) {
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