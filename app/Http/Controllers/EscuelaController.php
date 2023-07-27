<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use App\Models\Panel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EscuelaController extends Controller
{
    protected $user;
    public function __construct( Request $request){
        $this->user=$request->user();
    }

    protected function get_docentes(){
        $users=User::where('rol_id',3)->get();
        return $users;
    }

    protected function agregar_docente(Request $request){
        
            $request->validate([
                'nombre'=>'required',
                'dni'=>'required',
                'correo'=>'required|email',
                'telefono'=>'required',
            ]);
        try{
            $user=new User();
            $user->name=$request->nombre;
            $user->email=$request->correo;
            $user->email_verified_at=now();
            $user->telefono=$request->telefono;
            $user->rol_id=3;
            $user->password=Hash::make($request->dni);
            $user->dni=$request->dni;
            $user->save();

            return  $user;
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    protected function editar_docente(Request $request){
       
        $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'telefono'=>'required',
            'email'=>'required|email'
        ]);
        try{
        $user=User::findOrFail($request->id);
        $user->name=$request->name;
        $user->telefono=$request->telefono;
        $user->dni=$request->dni;
        $user->email=$request->email;

        $user->save();
        return $user;
       }catch(Exception $e){
        return response()->json(['message'=>$e->getMessage()],405);
       }    
    }

    protected function get_cursos(){
        try{
            $cursos=Panel::where('user_id',$this->user->id)->where('tipo',1)->get()->map(function($c){
                return[
                    'id'=>$c->id,
                    'nombre'=>$c->nombre,
                    'codigo'=>$c->codigo,
                    'tipo'=>$c->tipo,
                    'estado'=>$c->estado,
                    'periodo'=>$c->periodo,
                    'user_id'=>$c->user_ic,
                    'created_at'=>$c->created_at,
                    'docentes'=>$c->integrante->map(function($e){
                        if($e->rol==1){
                            return[
                                'id'=>$e->id,
                                'name'=>$e->user->name,
                                'dni'=>$e->user->dni,
                                'telefono'=>$e->user->telefono,
                                'email'=>$e->user->email,
                            ];
                        }
                    })->filter(function($value){
                        return $value !=null;
                    })
                ];
            });
            return $cursos;
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }


}
