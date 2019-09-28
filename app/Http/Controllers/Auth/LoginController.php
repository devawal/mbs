<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Account\Account;
use App\User;
use Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Show the login form.
     *
     * @return Response
     */
    public function showLogin()
    {
        return view('public_access.user_login');
    }

    /**
     * Get a validator for an incoming request.
     *
     * Get user login operation
     *
     * @param  array  $request
     *
     * @return Response
     */
    public function userAuthentication(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(array('email' => $email, 'password' => $password, 'is_active' => 1), true)) {
            return redirect()->route('user_dashboard');
        }
        else{
            Session::flash('error', 'Oops, Something went wrong. Please try again later!');
            return redirect()->back();
        }
    }

    /**
     * Show the registration form.
     *
     * @return Response
     */
    public function userRegistration()
    {
        return view('public_access.user_register');
    }


    /**
     * New account registration.
     *
     * @param  array  $request
     * @return Response
     */
    public function postRegistration(Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required|min:3',
            'last_name'     => 'required|min:3',
            'code'          => 'required|min:13|max:13',
            'email'         => 'required',
            'password'      => 'required|min:6',
        ]);
        
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        $account = Account::where('personal_code', $data['code'])->first();
        if (!empty($user) || !empty($account)) {
            Session::flash('error', 'Account exist!');
            return redirect()->back();
        }

        Account::createNewAccount($data);

        Session::flash('success', 'Account created, please use your credential to login');
        return redirect()->route('login');
    }

    /**
     * End session for active user.
     *
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
