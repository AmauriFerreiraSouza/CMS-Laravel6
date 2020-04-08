<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;//chamo minha view
use App\Page;//chamo minha model Page
use App\Setting;//chamo minha model Setting

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
        /**
         * MENU
         */

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
        //carrego nas minhas views
        View::share('front_menu', $frontMenu);

        /**
         * CONFIGURAÇÕES
         */

        //inicio a estrutura das minhas configurações 
        $frontSetting = []; 
        //pego todas as minhas configurações
        $settings = Setting::all();
        //pego os nomes e os conteúdos
        foreach($settings as $setting) {
            $frontSetting[ $setting['name'] ] = $setting['content'];
        }
        //carrego nas minhas views
        View::share('front_setting', $frontSetting);
    }
}
