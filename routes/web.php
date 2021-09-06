<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
/**
 *crio minha rota principal de acesso ao site 
 */
Route::get('/', 'Site\HomeController@index');
    
/**
 * crio o meu grupo de rotas para acessar login, logout, cadastro (register) e painel
 */
Route::prefix('painel')->group(function(){
    Route::get('/', 'Admin\HomeController@index')->name('admin');

    Route::get('login', 'Admin\Auth\LoginController@index')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@authenticate');

    Route::get('register', 'Admin\Auth\RegisterController@index')->name('register');
    Route::post('register', 'Admin\Auth\RegisterController@register');

    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

    //rota para uso sem resource
    //Route::get('users', 'Admin\UserController@index')->name('users');

    //rota para uso com resource
    Route::resource('users', 'Admin\UserController');
    Route::resource('pages', 'Admin\PageController');

    //rotas para o usuário
    Route::get('profile', 'Admin\ProfileController@index')->name('profile');
    Route::put('profile', 'Admin\ProfileController@save')->name('profile.save');

    //rotas para as configurações
    Route::get('settings', 'Admin\SettingController@index')->name('settings');
    Route::put('settings', 'Admin\SettingController@save')->name('settings.save');

});
    //crio minha rota de fallback para erros de páginas
    Route::fallback('Site\PageController@index');