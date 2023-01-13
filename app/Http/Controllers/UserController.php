<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Instância da classe User
     * @var User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = $this->user->all();

        return response()->json($user, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate($this->user->rules(), $this->user->feedback());

        $user = $this->user->create($request->all());

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
        $user = $this->user->with('newsletter')->find($id);

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
        $user = $this->user->find($id);

        if(is_null($user)){

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível realizar a atualização. O recurso solicitado não existe'
            ], 404);

        }

        if($request->method() === 'PATCH'){

            $rulesDynamics = [];

            foreach($user->rules() as $input => $rule){
                if(array_key_exists($input, $request->all())){
                    $rulesDynamics[$input] = $rule;
                }
            }

            $request->validate($rulesDynamics, $user->feedback());   
        }else{
            $request->validate($user->rules(), $user->feedback());   
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

        $user = $this->user->find($id);

        if(is_null($user)){

            return response()->json([
                'status' => 'Error',
                'message' => 'Não foi possível realizar a exclusão. O recurso solicitado não existe'
            ], 404);

        }

        $this->user->destroy($id);

        return response()->json([
            'status' => 'Success',
            'message' => 'O resurso foi excluído com sucesso'
        ], 200);
    }
}
