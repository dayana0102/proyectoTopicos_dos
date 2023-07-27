<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class PersonaController extends Controller
{
     public function get_personas(){
        try{
            $users=User::all()->map(function($u){
                return[
                    'id'=>$u->id,
                    'name'=>$u->name,
                    'rol_id'=>$u->rol_id,
                    'email'=>$u->email,
                    'dni'=>$u->dni,
                    'codigo'=>$u->codigo,
                    'rol'=>$this->funcion(function() use($u){
                        switch($u->rol_id){
                            case 1:
                                return 'Administrador';
                                break;
                            case 2: 
                                return 'Escuela';
                                break;
                            case 3:
                                return 'Docente';
                                break;
                            case 4:
                                return 'Alumno';
                                break;
                            default:
                                return 'ninguno';
                                break;
                        }
                    }),

                ];
            });


            return $users;
        }catch(Exception $e){
            return response()->json(['message'=>'errors',$e->getMessage()],405);
        }
     }


     public function funcion($funcion){
        return $funcion();
     }

     public function add_user(Request $request){
        $request->validate([
            'nombre'=>'required',
            'email'=>'required|email|unique:users',
            'rol'=>'required|numeric',
            'dni'=>'required|numeric',
        ]);
        try{
            $user= new User();
            $user->name=$request->nombre;
            $user->email=$request->email;
            $user->rol_id=$request->rol;
            $user->dni=$request->dni;
            $user->password=Hash::make($request->dni);
            $user->email_verified_at=now();
            $user->save();

            return $user;
        }catch(Exception $e){
            return response()->json(['message'=>'error',$e->getMessage()],405);
        }
     }
}
