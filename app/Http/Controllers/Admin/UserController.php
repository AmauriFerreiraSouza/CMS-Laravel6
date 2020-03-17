<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Lista na tela os meus usuários
     *     
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = User::paginate(10);
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * mostrar tela de cadastro
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * Armazene um usuário recém-criado no banco.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')
            ->withErrors($validator)
            ->withInput();
        }

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Mostra tela de edição com um usuário especifico através do id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if($user) {
            return view('admin.users.edit', ['user'=>$user]);
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Update the specified resource in storage.
     * Edita os dados de um usário específico no banco pelo id
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = User::find($id);

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
            if(count( $validator->errors() ) > 0) {
                return redirect()->route('users.edit', [
                    'user'=>$id
                ])->withErrors($validator);
            }

            $user->save();
        }
        
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
