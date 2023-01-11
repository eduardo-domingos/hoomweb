<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Newsletter::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Newsletter::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsletter = Newsletter::find($id);

        if(is_null($newsletter)){
            return [
                'status' => 'Error',
                'message' => 'A notícia pesquisado não existe'
            ];
        }

        return $newsletter;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::find($id);

        if(is_null($newsletter)){
            return [
                'status' => 'Error',
                'message' => 'Não foi possível atualizar as informações da notícia. A notícia não existe'
            ];
        }

        $newsletter->update($request->all());

        return $newsletter;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $newsletter = Newsletter::find($id);

        if(is_null($newsletter)){
            return [
                'status' => 'Error',
                'message' => 'Não foi possível realizar a exclusão. A notícia solicitado não existe'
            ];
        }

        Newsletter::destroy($id);

        return [
            'status' => 'Success',
            'message' => 'A notícia foi excluído com sucesso'
        ];
    }
}
