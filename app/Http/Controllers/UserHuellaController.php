<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint\UserHuella;
use Illuminate\Http\Request;

class UserHuellaController extends Controller
{
    public function __construct()
    {
        //
    }

    // public function verify(Request $request)
    // {
        
    //     $findUser = UserHuella::where('cod_usuario',$request->id_ocupacional)->first();

    //     if($findUser){
    //         if($findUser->huella) return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => $findUser->huella]);

    //         return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => false]);
    //     } 

    //     $user = new UserHuella();
    //     $user->cod_usuario = $request->id_ocupacional;
    //     $user->nombres= $request->nombres;
    //     $user->apellidos= $request->apellidos;
    
    //     if($user->save()){
    //         return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => false]);
    //     }

    //     return response(['success' => false, 'message' => 'Ocurrió un error...', 'huella' => false]);
    // }

    public function verify(Request $request)
    {
        // $findUser = UserHuella::where('cod_usuario',$request->id_ocupacional)->first();
        $findUser = UserHuella::first();
        
        if(!$findUser){
            $user = new UserHuella();
            $user->cod_usuario = $request->id_ocupacional;
            $user->nombres= $request->nombres;
            $user->apellidos= $request->apellidos;
            $user->nro_doc= $request->nro_doc;
            if($user->save()){
                return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => false]);
            }
            return response(['success' => false, 'message' => 'Ocurrió un error...', 'huella' => false]);
        } 
        


        if($findUser->cod_usuario == $request->id_ocupacional){
            if($findUser->huella) {
                $encodedHuella = base64_encode($findUser->huella);
                return response(['success' => true, 'message' => 'Huella recientemente añadida...', 'huella' => $encodedHuella]);}
            
            return response(['success' => true, 'message' => 'Registre la huella del paciente...', 'huella' => false]);
        }

        $findUser->cod_usuario = $request->id_ocupacional;
        $findUser->nombres = $request->nombres;
        $findUser->apellidos= $request->apellidos;
        $findUser->nro_doc= $request->nro_doc;
        $findUser->huella = null;

        if($findUser->save()){
            return response(['success' => true, 'message' => 'Paciente listo para tomar huella...', 'huella' => false]);
        }
        return response(['success' => false, 'message' => 'Ocurrió un error...', 'huella' => false]);
    }
}
