<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\GrupoTarea;
use App\Models\Integrante;
use App\Models\Panel;
use App\Models\Recurso;
use App\Models\SubTarea;
use Carbon\Carbon;
use Dompdf\FrameDecorator\TableRow;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PanelController extends Controller
{
    

    public function add_panel(Request $request){

        $request->validate([
            'nombre'=>'required|max:255',
            'periodo'=>'required',
            'docente'=>'required|numeric',
        ]);

        try{
            DB::transaction(function () use($request) {
                //creamos el panel
                $panel= new Panel();
                $panel->nombre=$request->nombre;
                $panel->codigo=strtolower(Str::random(5));
                $panel->user_id=$request->user()->id; //creador del panel
                $panel->tipo=1;  //curso 
                $panel->periodo=$request->periodo;
                $panel->estado=0;
                $panel->save();

                //ASIGNAMOS EL DOCENTE
                $docente= new Integrante();
                $docente->user_id=$request->docente;
                $docente->panel_id=$panel->id;
                $docente->rol=1;  //1=docente 2=alumno;
                $docente->save();
            });
            return response()->json(['message'=>'panel creado'], 200);
        }catch(Exception $e){
            return response()->json(['message'=>'error',$e->getMessage()],405);
        }
    }

    protected function editar_panel(Request $request){
        $request->validate([
            'id'=>'required|numeric',
            'nombre'=>'required',
            'periodo'=>'required',
        ]);

        try{
            $curso=Panel::findOrFail($request->id);
            $curso->nombre=$request->nombre;
            $curso->periodo=$request->periodo;
            $curso->save();

            return 'ok';
        }catch(Exception $e){
            return response()->json(['message'],405);
        }
    }


    protected function agregar_tablero(Request $request){
        try{
            $request->validate([
                'name'=>'required',
            ]);
            DB::transaction(function() use($request){
     
                $panel= new Panel();

                $panel->nombre=$request->name;
                $panel->tipo=2;
                $panel->estado=1;
                $panel->user_id= $request->user()->id;
                $panel->save();

                $int=new Integrante();
                $int->user_id=$request->user()->id;
                $int->rol=3; // panel propio dueño total
                $int->panel_id=$panel->id;
                $int->save();

            });
            return 'panel agregado';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }
  
    public function get_paneles_user(Request $request){
        try{

            $matriculas=Integrante::where('user_id',$request->user()->id)->get('panel_id');
            $panels=Panel::whereIn('id',$matriculas)->get();

            return $panels;
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    public function get_info_panel($id, Request $request){

        try{
            $p=Panel::findOrFail($id);
            $add_grupo=false;
            $docente=false;
            $alumno=false;
            $datodocente=null;
            $dueño=$p->user_id==$request->user()->id?true:false;
            $panel=[
                'id'=>$p->id,
                'nombre'=>$p->nombre,
                'tipo'=>$p->tipo,
                'estado'=>$p->estado,
                'periodo'=>$p->periodo,
                'integrantes'=>$p->integrante->map(function($i) use(&$add_grupo,$request,&$docente,&$alumno,&$datodocente){
                    if( in_array($i->rol,[1,3]) && $i->user_id==$request->user()->id){ 
                        $add_grupo=true;
                    }
                    if($i->rol==1 && $i->user_id == $request->user()->id){
                        $docente=true;
                    }
                    //buscar docente en 
                    if($i->rol==1){
                        $datodocente=$i->user;  
                    }

                    if($i->rol==2 && $i->user_id == $request->user()->id){
                        $alumno=true;
                        
                    }
     
                    return[
                        'id'=>$i->id,
                        'user_id'=>$i->user_id,
                        'nombre'=>$i->user->name,
                        'rol'=>$i->rol, //1 docente 2 alumno 3panel propio
                        'docente'=>$i->rol==1?true:false,
                        'alumno'=>$i->rol==2?true:false,
                        'dueño'=>$i->rol==3?true:false,
                        'telefono'=>$i->user->telefono,
                        'email'=>$i->user->email,
                    ];
                }),
                'grupos'=>$p->grupotarea->map(function($g) use($request,$docente,$alumno,$dueño){
                    
                    return[
                        'id'=>$g->id,
                        'nombre'=>$g->nombre,
                        'subtareas'=>$g->subtarea->map(function($s) use($request,$docente,$alumno,$dueño){
                            $addtarea=false;
                            $entrega=null;
                            if($s->tipo==2 && ($alumno || $dueño)){
                                $entrega=Entrega::where('subtarea_id',$s->id)->where('user_id',$request->user()->id)->first();
                                if(!$entrega ){
                                    $addtarea=true;
                                }
                            }
                            $tareas=null;
                            if($docente){
                                $tareas=$s->entrega->map(function($e){
                                    return[
                                        'id'=>$e->id,
                                        'fecha_entrega'=>Carbon::parse($e->fecha_entrega)->format('d-m-Y H:i:s'),
                                        'nota'=>$e->nota,
                                        'comentarios'=>$e->comentarios,
                                        'archivo'=>$e->archivo,
                                        'user_id'=>$e->user_id,
                                        'nombreuser'=>$e->user->name,
                                    ];
                                });
                            }
                            return[
                                'id'=>$s->id,
                                'nombre'=>$s->nombre,
                                'tipo'=>$s->tipo,
                                'fecha_limite'=>$s->fecha_limite,
                                'estado'=>$s->estado,
                                'created_at'=>$s->created_at,
                                'descripcion'=>$s->descripcion,
                                'recursos'=>$s->recurso,
                                'entrega'=>$entrega,
                                'addtarea'=>$addtarea,
                                'tareas'=>$tareas,
                            ];
                        }),
                        'editores'=>$g->editortarea->map(function($e){
                            return[
                                'id'=>$e->id,
                                'estado'=>$e->estado,
                                'nombre'=>$e->user->name,
                                'user_id'=>$e->user_id,
                            ];
                        }),
                    ];
                }),
                'addgrupo'=>$add_grupo,
                'docente'=>$docente,
                'alumno'=>$alumno,
                'dueño'=>$dueño,
                'datodocente'=>$datodocente,
            ];
            return $panel;
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }

    }

    public function add_grupo_panel(Request $request){
        try{
            $request->validate([
                'nameList'=>'required',
                'idtable'=>'required|numeric',
            ]);

            $table=Panel::findOrFail($request->idtable);
            //verificar si soy el docente o el dueño de este panel
            if(!$table->estado){
                abort(405,'panel deshabilitado');
            }
            $integrante=Integrante::where('panel_id',$request->idtable)->where('user_id',$request->user()->id)->whereIn('rol',[1,3])->first();

            if(!$integrante){
                abort(405,'Usted no puede agregar grupos en  este panel');
            }

            //agregamos el grupo

            $grupo= new GrupoTarea();
            $grupo->nombre=$request->nameList;
            $grupo->panel_id=$table->id;
            $grupo->user_id=$request->user()->id;
            $grupo->save();

            return 'lista agregada';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }


    protected function cambiarEstadoPanel($id){
        //return $id;
        $Panel=Panel::findOrFail($id);
        try{      
            $cambiado=$Panel->estado?0:1;
            Panel::where('id', $id)->update(['estado' => $cambiado]);
            return 'cambiado';
        }catch(Exception $e){
            return response()->json(['message'=>'Error en el servidor'],405);
        }
    }

    public function add_subtarea_grupo(Request $request){
        try{
            $request->validate([
                'panel_id'=>'required|numeric',
                'grupo_id'=>'required|numeric',
                'nombresubgrupo'=>'required',
                'tipo'=>'required|integer',
            ]);

            //verificar si mi rol de integrante es apto para crear subtareas
            //$panel=Panel::findOrFail($request->panel_id);
            $grupo=GrupoTarea::findOrFail($request->grupo_id);
            if($grupo->panel_id != $request->panel_id){
                abort(405,'No se econtro el panel');
            }
            $integrante=Integrante::where('panel_id',$grupo->panel_id)->where('user_id',$request->user()->id)->whereIn('rol',[1,3])->first();
            if(!$integrante){
                abort(405,'No tienes permiso para crear sub tareas');
            }
            //crear la sub tarea
            $subtarea=new SubTarea();
            $subtarea->nombre=$request->nombresubgrupo;
            $subtarea->grupotarea_id=$grupo->id;
            $subtarea->tipo=$request->tipo; 
            if($request->tipo==2){
                $subtarea->fecha_limite=$request->fechalimite;
            }
            $subtarea->estado=1;
            $subtarea->save();

            return 'sub tarea agregada';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    public function editar_subtarea_grupo(Request $request){
        try{
            $request->validate([
                'tipo'=>'required|integer',
                'fechalimite'=>'required_if:tipo,2',
                //'descripcion'=>'required',
                'id'=>'required',
                'name'=>'required',
            ]);

            $subtarea=SubTarea::findOrFail($request->id);
            $subtarea->descripcion=$request->descripcion;
            $subtarea->fecha_limite=$request->fechalimite;
            $subtarea->tipo=$request->tipo;
            $subtarea->nombre=$request->name;
            $subtarea->save();
            return 'actualizado';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    public function agregar_recurso_tarea(Request $request){
        try{
            $request->validate([
                'nombre'=>'required',
                'archivo'=>'required_if:tipo,1',
                'texto'=>'required_if:tipo,3',
                'id'=>'required|numeric',
            ]);

            if($request->tipo==2 && $request->texto=='' ){
                abort(405,'completa campos');
            }

            $subtarea=SubTarea::findOrFail($request->id);

            //adjuntamos los datos;
            $texto='';
            if($request->tipo==2){
                $texto='<a href="'.$request->texto.'" target="_blank">'.$request->texto.'</a>';
            }else{
                $texto=$request->texto;
            }
            $url='';
            if($request->tipo==1){
                $url=Storage::url($request->file('archivo')->store('recursos','public'));
            }

            $recurso= new Recurso();
            $recurso->nombre=$request->nombre;
            $recurso->subtarea_id=$subtarea->id;
            $recurso->archivo=$url;
            $recurso->texto=$texto;
            $recurso->user_id=$request->user()->id;
            $recurso->save();
            
            return 'recurso añadido';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    public function del_recurso(Request $request){
        try{
            $request->validate([
                'panel_id'=>'required|numeric',
                'recurso_id'=>'required|numeric',
                'subtarea_id'=>'required|numeric',
            ]);

            //$subtarea=SubTarea::findOrFail($request->subtarea)
            $recurso=Recurso::findOrFail($request->recurso_id);
            if($recurso->user_id!=$request->user()->id){
                abort(405,'No puedes eliminar el recurso');
            }

            if($recurso->archivo){
                $path = public_path().$recurso->archivo;
               try{unlink($path);}catch(Exception){};
            }

            $recurso->delete();

            return 'recurso eliminado';

        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    public function archivar_subtarea_grupo(Request $request){
        try{
            $request->validate([
                'panel_id'=>'required|numeric',
                'subtarea_id'=>'required|numeric',
            ]);

            $subtarea=SubTarea::findOrFail($request->subtarea_id);
            //$panel=Panel::findOrFail($request->panel_id);
            $subtarea->estado=!$subtarea->estado;
            $subtarea->save();
            return 'archivado';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }


    public function enviar_tarea(Request $request){
        try{
            $request->validate([
                'archivo'=>'required|file',
                'comentario'=>'nullable',
                'subtarea_id'=>'required|numeric',
            ]);

            $subtarea=SubTarea::findOrFail($request->subtarea_id);

            //verificar si ya se envió la tarea
            $entrega=Entrega::where('subtarea_id',$subtarea->id)->where('user_id',$request->user()->id)->first();
            if($entrega?->nota){
                abort(405,'Ya te revisaron');
            }

            $entrega=new Entrega();
            $url=Storage::url($request->file('archivo')->store('tareas','public'));
            $entrega->archivo=$url;
            $entrega->comentarios=$request->comentario;
            $entrega->fecha_entrega=Carbon::now();
            $entrega->subtarea_id=$subtarea->id;
            $entrega->user_id=$request->user()->id;
            $entrega->save();
            return 'tarea agregada';
        }catch(Exception $e){   
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    public function eliminar_tarea(Request $request){
        try{
            $request->validate([
                'subtarea_id'=>'required|numeric',
                'tarea'=>'required|numeric',
            ]);

            $tarea=Entrega::findOrFail($request->tarea);
            if($tarea->subtarea_id!=$request->subtarea_id){
                abort(405,'Error al eliminar la tarea');
            }

            //verificar si eres el usuario que subio
            if($tarea->user_id!=$request->user()->id ){
                abort(405,'Error al identificar usuario');
            }

            if($tarea->nota){
                abort(405,'La tarea ya fue calificada');
            }
            //eliminar
            $tarea->delete();
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }

    public function revisar_tarea(Request $request){
        try{
            $request->validate([
                'entrega_id'=>'required|numeric',
                'nota'=>'required|numeric',
            ]);

            $entrega=Entrega::findOrFail($request->entrega_id);
            $entrega->nota=$request->nota;
            $entrega->save();
            return 'Nota agregada';
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],405);
        }
    }
}
