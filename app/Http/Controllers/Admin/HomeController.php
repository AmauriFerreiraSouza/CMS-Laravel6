<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{   
    /**
     * crio meu métdodo construtor para redirecdionar para a index,
     * não esteja logado 
     */
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * crio minha index para a tela do painel administrativo */    
    public function index () {
        return view('admin.home');
    }
}
