<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * crio meu método que exibe minha tela de configurações
     */
    public function index(){

        $settings = [];

        $dbsettings = Setting::get();

        foreach($dbsettings as $dbsetting) {
            $settings[ $dbsetting['name']] = $dbsetting['content']; 
        }

        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }
}
