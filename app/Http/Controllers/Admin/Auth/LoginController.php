<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/painel';

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
     * crio minha index para tela de login
     */
    public function index() {
        return view('admin.login');
    }
    /**
     * crio meu método que autentica o usuário através de um email e senha
     */
    public function authenticate(Request $request) {
        $data = $request->only([
            'email',
            'password',
            'remember'
        ]);

        $validator = $this->validator($data);

        if($validator->fails()) {
            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput();
        }

        if(Auth::attempt($data)){
            return redirect()->route('admin');
        } else {
            $validator->errors()->add('password', 'E-mail e/ou senha errados!');
            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput();
        }
    }
    /**
     * crio meu método logout
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    /**
     * crio meu método logout
     */
    public function validator(array $data) {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:4']
        ]);
    } 
}
