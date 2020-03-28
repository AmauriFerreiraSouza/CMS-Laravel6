<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{   
    /**
     * crio meu método construtor e passo o middleware
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * crio meu método que mostra minha tela de Usuário
     * pego o id do usuário logado
     */
    public function index(){
        $isLoggedId = intval(Auth::id());

        $user = User::find($isLoggedId);

        if($user) {
            return view('admin.profile.index', [
                'user' =>$user
            ]);
        } 
        return redirect()->route('admin');
    }

    /**
     * crio o método que salva as auterações do usário logado
     */
    public function save(Request $request){
        $isLoggedId = intval(Auth::id());
        $user = User::find($isLoggedId);

        if($user){
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make($data,[
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100']
            ]);

            //1. Alteração do nome
            $user->name = $data['name'];
            //2. Alteração do email
            //2.1 Verificamos se o email foi alterado
            if($user->email != $data['email']){
                //2.2 verfico se o novo email já existe
                $hasEmail = User::where('email', $data['email'])->get();
                if(count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique',[
                        'attribute' => 'email'
                    ]));
                }
            }

            //3. Alterção de senha
            //3.1 Verifica se o usuário enseriu uma senha
            if(!empty($data['password'])) {
                //3.2 Verifico se a senha digitada é maior ou igual 2
                if(strlen($data['password']) >= 4){
                    //3.3 Verifico se a senha é igual a senha de confirmação
                    if($data['password'] === $data['password_confirmation']) {
                        //gravo a senha
                        $user->password = Hash::make($data['password']);
                    } else {
                        //se não trago a mensagem de erro
                        $validator->errors()->add('password', __('validation.confirmed',[
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    //mensagem de erro de quantidade de caracteres
                    $validator->errors()->add('password', __('validation.min.string',[
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }
            //jogo meu validator no final para trazer todos os erros 
            if(count($validator->errors() ) > 0) {
                return redirect()->route('profile', [
                    'user'=>$isLoggedId
                ])->withErrors($validator);
            }

            $user->save();

            return redirect()->route('profile')
            ->with('warning', 'Informações salvas com sucesso!');
        }

        return redirect()->route('profile');
    }
}
