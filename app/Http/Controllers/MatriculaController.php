<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use App\Models\Panel;
use Exception;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    
    private $user;
    public function __construct( Request $request){
        $this->user=$request->user();

        if($this->user->rol_id!=4){
            abort( response()->json(['message'=>'No Autorizado'],405) );
        }
    }
    

    protected function matricularse(Request $request){
        $request->validate([
            'codigo'=>'required',
        ]);

        try{
            $curso=Panel::where('codigo',$request->codigo)->first();
            if(!$curso){
                abort(405,'error al encontrar el curso');
            }

            if(!$curso->estado){
                abort(405,'No puedes matricularte');
            }

            //verificar si ya estas matriculado;
            $integrante=Integrante::where('user_id',$this->user->id)->where('panel_id',$curso->id)->first();
            if($integrante){
                abort(405,'ya estas matriculado');
            }

            //matricularse
            $int= new Integrante();
            $int->user_id=$this->user->id;
            $int->panel_id=$curso->id;
            $int->rol=2; //alumno
            $int->save();

            return 'matriculado';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    protected function salir_curso(Request $request){
        try{
            $request->validate([
                'panel'=>'required|numeric',
            ]);

            $panel=Panel::findOrFail($request->panel);
            Integrante::where('panel_id',$panel->id)->where('user_id',$this->user->id)->delete();
            return 'eliminado';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }
}
