<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{

    /**
     * Instância da classe Newsletter
     */
    private Newsletter $newsletter;

    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newsletter = [];

        if($request->has('attributes_user')){
            $attributes_newsletter = $request->query('attributes_user');
            $newsletter = $this->newsletter->with('user:id,'.$attributes_newsletter);
        }else{
            $newsletter = $this->newsletter->with('user');
        }

        if($request->has('filter')){
            $filters = explode(';', $request->query('filter'));

            foreach($filters as $key => $conditions){
                $condition = explode(':', $conditions);                
                $newsletter = $newsletter->where($condition[0], $condition[1], $condition[2]);
            }

        }

        if($request->has('attributes')){
            $attributes = $request->query('attributes');
            $newsletter = $newsletter->selectRaw($attributes)->get();
        }else{
            $newsletter = $newsletter->get();
        }

        return response()->json($newsletter, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->newsletter->rules(), $this->newsletter->feedback());

        $newsletter = $this->newsletter->create($request->all());

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
        $newsletter = $this->newsletter->with('user')->find($id);

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
        $newsletter = $this->newsletter->find($id);

        if(is_null($newsletter)){

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível atualizar as informações da notícia. A notícia não existe'
            ], 404);

        }

        if($request->method() === 'PATCH'){

            $rulesDynamics = [];

            foreach($newsletter->rules() as $input => $rule){
                if(array_key_exists($input, $request->all())){
                    $rulesDynamics[$input] = $rule;
                }
            }

            $request->validate($rulesDynamics, $newsletter->feedback());   
        }else{
            $request->validate($newsletter->rules(), $newsletter->feedback());   
        }

        $newsletter->fill($request->all());

        $newsletter->save();

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

        $newsletter = $this->newsletter->find($id);

        if(is_null($newsletter)){

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível realizar a exclusão. A notícia solicitado não existe'
            ], 404);

        }

        $this->newsletter->destroy($id);

        return response()->json([
            'status' => 'Success',
            'message' => 'A notícia foi excluído com sucesso'
        ], 200);
    }
}
