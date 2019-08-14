<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LoginRepository;
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Adminlogin(Request $request)
    {
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
        return view('tutor.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Tutorlogin(Request $request)
    {
        if (Auth::guard('tutor')->attempt([
            'TutorEmail' => $request->TutorEmail, 
            'password' => $request->TutorPassword
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
     * Change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->getUser();    
        }

        if (Auth::guard('tutor')->check()) {
            $user = Auth::guard('tutor')->getUser();    
        }

        return view('auth.change_password', compact('user'));
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
                return redirect()->route('change_password')->with('success', 'Password change successfully!');
            }
        }

        if (Auth::guard('tutor')->check()) {
            $user = Auth::guard('tutor')->user();
            if (Hash::check($request->get('current_password'), $user->TutorPassword)) {
                $user->TutorPassword = Hash::make($request->get('new_password'));
                $user->save();
                return redirect()->route('change_password')->with('success', 'Password change successfully!');
            }
        }
        return redirect()->back()->withErrors('Current password is incorrect');
    }
}