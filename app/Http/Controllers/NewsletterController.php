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
        return response()->json(Newsletter::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newsletter = Newsletter::create($request->all());

        return response()->json($newsletter, 201);
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

            return response()->json([
                'status' => 'Error',
                'message' => 'A notícia pesquisado não existe'
            ], 404);

        }

        return response()->json($newsletter, 200);
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

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível atualizar as informações da notícia. A notícia não existe'
            ], 404);

        }

        $newsletter->update($request->all());

        return response()->json($newsletter, 200);
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

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível realizar a exclusão. A notícia solicitado não existe'
            ], 404);

        }

        Newsletter::destroy($id);

        return response()->json([
            'status' => 'Success',
            'message' => 'A notícia foi excluído com sucesso'
        ], 200);
    }
}
