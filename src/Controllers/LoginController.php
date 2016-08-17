<?php

namespace Mascame\Artificer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo;
    protected $redirectAfterLogout;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->redirectTo = \URL::route('admin.home');
        $this->redirectAfterLogout = \URL::route('admin.login.show');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->redirectAfterLogout);
    }

    protected function validateLogin(Request $request)
    {
        // Allow email or username
        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $this->username = $field;
        $request->merge([$field => $request->input('username')]);

        return $this->validate($request, [
            'username' => 'required|max:255',
            'password' => 'required|min:6',
        ]);
    }

    public function showLoginForm()
    {
        return view('artificer-login::login');
    }

    public function showRegistrationForm()
    {
        return view('artificer-login::register');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function username()
    {
        return 'username';
    }
}
