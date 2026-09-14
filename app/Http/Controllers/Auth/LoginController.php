<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = '/admin';

    public function showLoginForm()
    {
        $previousUrl = url()->previous();
        $baseUrl = url()->to('/');
        if ($previousUrl != $baseUrl . '/login') {
            session()->put('url.intended', $previousUrl);
        }

        return view('auth.login');
    }

    protected function authenticated($request, $user)
    {
        if (Auth::user()->status == 'admin') {
            return redirect('admin/dashboard');
        } else {
            $this->showLoginForm();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
