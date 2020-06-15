<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        // dd(Auth::check('web'));
        // $this->middleware('guest')->except('logout');
    // }
    protected function guard()
    {
        return Auth::guard('web');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            // Аутентификация успешна...
            // dd(Auth::user()->name);
            return redirect('/home');
        }else{
            dd(Auth::guard('web')->user());
        }
    }
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     dd($credentials);
    //     if (Auth::attempt($credentials)) {
    //         // Аутентификация успешна...
    //         return redirect('/home');
    //     }
    // }
    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

}
