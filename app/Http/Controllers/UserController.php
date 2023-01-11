<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return [
                'status' => 'Error',
                'message' => 'O recurso pesquisado não existe'
            ];
        }

        return $user;
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
        $user = User::find($id);

        if(is_null($user)){
            return [
                'status' => 'Error',
                'message' => 'Não foi possível realizar a atualização. O recurso solicitado não existe'
            ];
        }

        $user->update($request->all());

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);

        if(is_null($user)){
            return [
                'status' => 'Error',
                'message' => 'Não foi possível realizar a exclusão. O recurso solicitado não existe'
            ];
        }

        User::destroy($id);

        return [
            'status' => 'Success',
            'message' => 'O resurso foi excluído com sucesso'
        ];
    }
}
