<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Funcionario;

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
    protected $redirectTo = '/inicio';

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
     * metodo sobrescrito para logar com username
     *
     * @return void
     */

    protected function credentials(Request $request)
    {

        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'cpf';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);

    //     // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //     // the login attempts for this application. We'll key this by the username and
    //     // the IP address of the client making these requests into this application.
    //     if ($this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }

    //     if ($this->attemptLogin($request) == 3) {

    //         return $this->sendLoginResponse($request);
    //     }

    //     // If the login attempt was unsuccessful we will increment the number of attempts
    //     // to login and redirect the user back to the login form. Of course, when this
    //     // user surpasses their maximum number of attempts they will get locked out.
    //     if($this->attemptLogin($request) % 2 ==0){

    //         $this->incrementLoginAttempts($request);
    //     }


    //      //dd(1);

    //     //return redirect('logout');
    //     return $this->sendFailedLoginResponse($request);
    // }

    // protected function attemptLogin(Request $request)
    // {
    //     $data = ($this->credentials($request));
    //     $res = $this->verify_access($data);
    //     $res += $this->guard()->attempt($this->credentials($request), $request->filled('remember'))?1:0;
    //     //dd($res);
    //     //res = 3 -> senha e login ok e com acesso ao sistema
    //     //res = 1 -> senha e login ok porém sem acesso ao sistema
    //     //res = 0 ou res = 2 senha ou login não conferem e não tem acesso
    //     return $res;
    // }

    // public function verify_access($data){
    //     $funcionario = Funcionario::where(array_keys($data)[0],$data[array_keys($data)[0]])->first();
    //     if($funcionario->acesso_sistema)
    //         return 2;

    //     return 0;
    // }

}
