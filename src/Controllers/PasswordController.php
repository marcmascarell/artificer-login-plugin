<?php

namespace Mascame\Artificer\Controllers;

use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $resetView = 'artificer-login::passwords.reset';
    protected $linkRequestView = 'artificer-login::passwords.email';
    protected $broker = 'admin';
    protected $guard = 'admin';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = \URL::route('admin.home');

        $this->middleware($this->guestMiddleware());

        parent::__construct();
    }

}
