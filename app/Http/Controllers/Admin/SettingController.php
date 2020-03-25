<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{   
    /**
     * crio meu método que exibe minha tela de configurações
     */
    public function index(){

        return view('admin.settings.index');
    }
}
