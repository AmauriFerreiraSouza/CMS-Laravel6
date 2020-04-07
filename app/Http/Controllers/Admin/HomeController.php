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
    public function index (Request $request) {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        //pego o valor do meu input
        $interval = intval($request->input('interval', 30));
        //faço uma verificação para impedir que o valor enviado seja maior que o limite de 120 dias
        if($interval > 120){
            $interval = 120;
        }

        /*Contagem de visitantes
        *armazeno dentro de uma variável a data atual, menos o valor do input enviado (-30 dias, -2 meses, -3 meses ou -6 meses)
        */
        $dateInterval = date('Y-m-d', strtotime('-'.$interval.'days'));
        
        //trago a quantidade de datas maiores ou iguais a data vinda do dateInterval
        $visitsCount = Visitor::where('date_access', '>=', $dateInterval)->count();

        /**Contagem de usuários online
        * pego a data atual menos 5 minutos
        */
        $dateLimit = date('Y-m-d', strtotime('-5 minutes'));
        //seleciono o ip ordenado por grupos aonde a data de acesso for menor que 5 minutos atrás
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $dateLimit)->groupBy('ip')->get();
        //conto o meu retorno de ips
        $onlineCount = count($onlineList);

        //Contagem de páginas
        $pageCount = Page::count();

        //Contagem de usuários
        $userCount = User::count();

        /*Contagem para o pagePie
        * trago a quantidade de datas maiores ou iguais a data vinda do dateInterval
        */
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as c')
        ->where('date_access', '>=', $dateInterval)
        ->groupBy('page')
        ->get();
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
            'pageValues' => $pageValues,
            'dateInterval' => $interval
        ]);
    }
}
