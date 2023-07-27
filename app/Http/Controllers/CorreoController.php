<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CorreoController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function datosusuario($codigo){    
        try{
            $user = Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/'.$codigo);
            if(isset($user['message']) ){
                return response()->json(['message'=>'Código no encontrado'],405);
            }
            $correo=trim($user['Correo Institucional']);
            if($correo==''){
                return response()->json(['message'=>'Su código no está asociado a un correo'],405);
            }
            $validate= (false !==filter_var($correo, FILTER_VALIDATE_EMAIL));
            if($validate){
                return $correo;
            } 
            return response()->json(['message'=>'Correo inválido' ,'correo'=>$correo],409);
        }catch (Exception){
           return response()->json(['message' => 'Error de conexion'],405);
        }                     
    }
}


