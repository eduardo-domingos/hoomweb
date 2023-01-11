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
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
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

            return response()->json([
                'status' => 'Error',
                'message' => 'O recurso pesquisado não existe'
            ], 404);

        }

        return response()->json($user, 200);
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

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível realizar a atualização. O recurso solicitado não existe'
            ], 404);

        }

        $user->update($request->all());

        return response()->json($user, 200);
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

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível realizar a exclusão. O recurso solicitado não existe'
            ], 404);

        }

        User::destroy($id);

        return response()->json([
            'status' => 'Success',
            'message' => 'O resurso foi excluído com sucesso'
        ], 200);
    }
}
