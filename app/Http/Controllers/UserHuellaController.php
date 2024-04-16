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
                return response(['success' => true, 'message' => 'Paciente listo para tomar datos...', 'huella' => false, 'firma' => false]);
            }
            return response(['success' => false, 'message' => 'Ocurrió un error...', 'huella' => false, 'firma' => false]);
        } 
        


        if($findUser->cod_usuario == $request->id_ocupacional){
            if($findUser->huella && $findUser->firma) {
                $encodedHuella = base64_encode($findUser->huella);
                $encodedFirma = base64_encode($findUser->firma);
                return response(['success' => true, 'message' => 'Datos recientemente añadidos...', 'huella' => $encodedHuella,'firma' => $encodedFirma]);
            }
            return response(['success' => true, 'message' => 'Registre huella/firma del paciente...', 'huella' => false ,'firma' => false]);
        }

        $findUser->cod_usuario = $request->id_ocupacional;
        $findUser->nombres = $request->nombres;
        $findUser->apellidos= $request->apellidos;
        $findUser->nro_doc= $request->nro_doc;
        $findUser->huella = null;
        $findUser->firma = null;

        if($findUser->save()){
            return response(['success' => true, 'message' => 'Paciente listo para tomar datos...', 'huella' => false, 'firma' => false]);
        }
        return response(['success' => false, 'message' => 'Ocurrió un error...', 'huella' => false, 'firma' => false]);
    }

    public function close ($cod){
        $findUser = UserHuella::where('cod_usuario',$cod)->first();

        if($findUser) {
            $findUser->cod_usuario = 0;
            $findUser->nombres = "PACIENTE";
            $findUser->apellidos= "TEMP";
            $findUser->nro_doc= null;
            $findUser->huella = null;
            $findUser->firma = null;
            $findUser->save();

            return response(['success' => true, 'message' => 'Paciente limpiado']);
        }

        return response(['success' => false, 'message' => 'Paciente no se encontró']);
    }
}
