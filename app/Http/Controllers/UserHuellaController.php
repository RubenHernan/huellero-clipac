<?php

namespace App\Http\Controllers;

use App\Models\Huellero\UserHuella;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function verify(Request $request)
    {
        $findUser = UserHuella::where('cod_ocupacional',$request['id_ocupacional'])->first();

        if($findUser){
            if($findUser->huella) return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => $findUser->huella]);

            return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => false]);
        } 

        $user = new UserHuella();
        $user->cod_usuario = $request['id_ocupacional'];
        $user->nombres= $request['nombres'];
        $user->apellidos= $request['apellidos'];
    
        if($user->save()){
            return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => false]);
        }

        return response(['success' => false, 'message' => 'Ocurrió un error...', 'huella' => false]);
    }
}
