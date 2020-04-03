<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Visitor;
use App\User;
use App\Page;

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
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        
        //Contagem de visitantes
        $visitsCount = Visitor::count();

        //Contagem de usuários online
        //pego a data atual menos 5 minutos
        $dateLimit = date('Y-m-d', strtotime('-5 minutes'));
        //seleciono o ip ordenado por grupos aonde a data de acesso for menor que 5 minutos atrás
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $dateLimit)->groupBy('ip')->get();
        //conto o meu retorno de ips
        $onlineCount = count($onlineList);

        //Contagem de páginas
        $pageCount = Page::count();

        //Contagem de usuários
        $userCount = User::count();

        //Contagem para o pagePie
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as c')->groupBy('page')->get();
        foreach($visitsAll as $visit) {
            $pagePie[ $visit['page'] ] = intval($visit['c']); 
        }

        //pego esses valores através do meu json_encode
        $pageLabels = json_encode( array_keys($pagePie) ); 
        $pageValues = json_encode( array_Values($pagePie) );

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues
        ]);
    }
}
