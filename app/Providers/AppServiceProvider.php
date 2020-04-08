<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;//chamo minha view
use App\Page;//chamo minha model Page

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        //inicio a estrutura do meu menu com home
        $frontMenu = [
            '/' => 'home'
        ];
        //pego todas as minhas páginas
        $pages = Page::all();
        //pego os slugs e os títulos
        foreach($pages as $page) {
            $frontMenu[ $page['slug'] ] = $page['title'];
        }
        //carrego minhas views
        View::share('front_menu', $frontMenu);
    }
}
