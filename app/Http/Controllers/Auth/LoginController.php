<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Config;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdminLoginForm()
    {
        $this->middleware('guest:admin')->except('logout');
        return view('auth.login', ['url' => 'admin']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOwnerLoginForm()
    {
        $this->middleware('guest:owner')->except('logout');
        return view('auth.login', ['url' => 'owner']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStaffLoginForm()
    {
        $this->middleware('guest:staff')->except('logout');
        return view('auth.login', ['url' => 'staff']);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
    }

    /**
     * @param Request $request
     * @param $guard
     * @return bool
     */
    // protected function guardLogin(Request $request, $guard)
    // {
    //     $this->validator($request);

    //     return Auth::guard($guard)->attempt(
    //         [
    //             'email' => $request->email,
    //             'password' => $request->password
    //         ],
    //         $request->get('remember')
    //     );
    // }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminLogin(Request $request)
    {
        $this->middleware('guest:admin')->except('logout');
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }



    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ownerLogin(Request $request)
    {
       $this->middleware('guest:owner')->except('logout');

        if (Auth::guard('owner')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/owner');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
        /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function staffLogin(Request $request)
    {
       $this->middleware('guest:staff')->except('logout');

        if (Auth::guard('staff')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/staff');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
}
