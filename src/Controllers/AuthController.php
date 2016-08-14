<?php

namespace Mascame\Artificer\Controllers;

use Illuminate\Http\Request;
use Mascame\Artificer\ArtificerUser;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo;

    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = \URL::route('admin.home');
        $this->redirectAfterLogout = \URL::route('admin.showlogin');

        $this->resetView = 'artificer-login::password.reset';

        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

        parent::__construct();
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:artificer_users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return ArtificerUser
     */
    protected function create(array $data)
    {
        return ArtificerUser::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'user',
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

}