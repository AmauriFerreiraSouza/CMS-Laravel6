<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{   
    /**
     * crio minha index para a tela do site principal 
     */
    public function index () {
        return view('site.home');
    }
}
