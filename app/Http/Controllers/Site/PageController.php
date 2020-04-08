<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{   
    /**
     * tela das páginas
     */
    public function index($slug){
        //pego tudo que há na minha page
        $page = Page::where('slug', $slug)->first();
        //verifico se houve retorno
        if($page){
            return view('site.page', [
                'page' => $page
            ]);
        } else {
            //não havendo a page entra na 404
            abort(404);
        }
    }
}
