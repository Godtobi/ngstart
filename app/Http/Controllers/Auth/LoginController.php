<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;


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
//    protected $redirectTo = '/home';
//    protected function sendFailedLoginResponse(Request $request)
//    {
//    throw ValidationException::withMessages([
//    $this->username() => [trans('auth.failed')],
//    ])->redirectTo("/signin"); }

//    protected function sendFailedLoginResponse(Request $request)
//    {
//        return redirect()->to('/signin')
//            ->withInput($request->only($this->username(), 'remember'))
//            ->withErrors([
//                $this->username() => Lang::get('auth.failed'),
//            ]);
//    }

    protected function redirectTo()
    {
        $role = Auth::user()->role;
        $email = Auth::user()->email;


        if($role || $email=='admin@gmail.com'){
            return route('users');

        }
        return route('index');
//
//        return view('frontend.frontend.admin');

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
