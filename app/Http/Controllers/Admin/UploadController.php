<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{   
    //crio meu método que faz upload de imagens
    public function imageupload(Request $request) {
        //faço uma validação para verificar o tipo de imagem
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        //pego a extensão dela    
        $ext = $request->file->extension();
        //dou um nome aleatório para evitar quando enviada imagens iguais uma não substitua a outra     
        $imageName = time().'.'.$ext;
        //defino o local de salvamento desta imagem    
        $request->file->move(public_path('media/images'), $imageName);
        //apos o processo dou um retorno para o link da minha imagem    
        return [
            'location' => asset('media/images/'.$imageName)
        ];
    }
}
