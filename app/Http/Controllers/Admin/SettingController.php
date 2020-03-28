<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Setting;

class SettingController extends Controller
{   
    /**
     * crio meu método construtor para dar acesso somente
     * a quem estiver logado 
     */    
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

    /**
     * crio meu método que salva as alterações das configurações da página
     */
    public function save(Request $request) {

        $data = $request->only([
            'title', 'subtitle', 'email', 'bgcolor', 'textcolor'
        ]);

        $validator = $this->validator($data);

        if($validator->fails()){
            return redirect()->route('settings')
            ->withErrors($validator);
        }

        foreach($data as $item => $value) {
            Setting::where('name', $item)->update([
                'content' => $value
            ]);
        }

        return redirect()->route('settings')
        ->with('warning', 'Informações salvas com sucesso!');
    }

    /**
     * crio meu método que valida os inputs
     */
    protected function validator($data) {
        return Validator::make($data, [
            'title' => ['required','string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'bgcolor' => ['required', 'string', 'regex:/#[A-Z0-9]{6}/i'],
            'textcolor' => ['required', 'string', 'regex:/#[A-Z0-9]{6}/i']
        ]);

    }
}
