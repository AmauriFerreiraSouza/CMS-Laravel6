<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * Tela de listagem das páginas
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pages = Page::paginate(10);

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * Tela de cadastro de nova página
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     * Método de cadastro de nova página
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'body'
        ]);

        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'body' => ['string'],       
            'slug' => ['required', 'string', 'max:100', 'unique:pages']
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.create')
            ->withErrors($validator)
            ->withInput();
        }

        $page = new Page;
        $page->title = $data['title'];
        $page->body = $data['body'];
        $page->slug = $data['slug'];
        $page->save();

        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Tela de formulário para edição das minhas páginas específicas 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);

        if($page) {
            return view('admin.pages.edit', ['page'=>$page]);
        }
        return redirect()->route('admin.pages.index');
    }

    /**
     * Update the specified resource in storage.
     * Edito os dados específicos de uma página 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        if($page){
            $data = $request->only([
                'title',
                'body'
            ]);
        //verfico se o campo title, foi auterado
        if($page['title'] !== $data['title']) {
            //se foi armazeno no meu slug o novo title
            $data['slug'] = Str::slug($data['title'], '-');
            //verifico pelo validator se o slug novo já existe com o "unique"
            $validator = Validator::make($data, [
                'title' => ['required', 'string', 'max:100'],
                'body' => ['string', 'max:100'],
                'slug' => ['required', 'string', 'max:100', 'unique:pages']
            ]);

        } else {
            //se meu campo title não foi alterado continuo com a validação simples
            $validator = Validator::make($data, [
                'title' => ['required', 'string', 'max:100'],
                'body' => ['string', 'max:100']

            ]);
        }   
        //pego os erros do meu validator
        if($validator->fails()) {
            return redirect()->route('pages.edit',[
                'page' => $id
            ])
            ->withErrors($validator)
            ->withInput();
        }
            //salvo os dados normalmente
            $page->title = $data['title'];
            $page->body = $data['body'];
            //verifico se o meu campo slug foi preenchido
            if(!empty($data['slug'])){
                //salvo o dado normal
                $page->slug = $data['slug'];
            }

            $page->save();
        }
        
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     * Remove uma página especifica
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect()->route('pages.index');
    }
}
