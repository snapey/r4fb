<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordlessLogin;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function passwordless(Request $request)
    {
        //check the email passed is still valid, bu getting the user
        //send the user a secure email which will allow them to login
        //need route where the token can be validated
        $user = User::where('email',$request->email)->firstOrFail();

        Mail::to($user->email)->send(new PasswordlessLogin($user, $request->remember));

        alert()
            ->persistent(true,true)
            ->info('Please check your email', 'You have been sent an email that contains a link to immediately log you into the application');

        return redirect(route('login'));

    }


    public function link(User $user, Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        Auth::login($user, $request->has('remember'));

        toast()->success('Success, logged in');

        return redirect($this->redirectTo);
    }


    public function authenticated(Request $request, User $user)
    {
        toast()->success('Success, logged in');

        return redirect($this->redirectTo);
    }

    private function loggedOut($request)
    {
        return redirect(route('logout'));
    }
}
