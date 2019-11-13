<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	protected function authenticated(Request $request, $user)
    {
        if ($user->block == 'Y') {
            Auth::logout();

            return redirect('login')->with('flash_message', __('auth.blocked'));
        }
    }
	
	public function authenticate(Request $request)
	{
		$email = $request->email;
		$password = $request->password;

		if (Auth::attempt(['email' => $email, 'password' => $password, 'block' => 'N'])) {
			return redirect()->intended('dashboard');
		}
	}
	
	protected function credentials(Request $request)
	{
		$field = $this->field($request);

		return [
			$field => $request->get($this->username()),
			'password' => $request->get('password'),
		];
	}
	
	public function field(Request $request)
	{
		$email = $this->username();

		return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
	}
	
	protected function validateLogin(Request $request)
	{
		$field = $this->field($request);

		$messages = ["{$this->username()}.exists" => 'The account you are trying to login is not registered or it has been disabled.'];

		$this->validate($request, [
			$this->username() => "required|exists:users,{$field}",
			'password' => 'required',
		], $messages);
	}
}
