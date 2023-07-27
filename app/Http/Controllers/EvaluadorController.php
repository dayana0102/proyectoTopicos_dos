<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


     public function listar_evaluador(){
        $ch=curl_init();

        $array=[
            'usuariows'=>'app',
            'clavews'=>'fa0801',
            'op'=>'listar_evaluador'
        ];
        $data=http_build_query($array);
        curl_setopt($ch,CURLOPT_URL,'http://192.168.1.20/webApiSql/wa/atencion.php');
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $response=curl_exec($ch);
        
        $evaluadores=json_decode($response,true);
        return response()->json($evaluadores['listar_evaluador'],200);
     }  
     
    public function evaluador_create(Request $request){
        $estado='N';
       /* $request->validate([
            'codigo'=>'required',
            'colegiatura'=>'required',
            'profesion'=>'required',
            'apellidos'=>'required',
            'nombres'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'usuario'=>'required',
        
            'postfirma'=>'required',
           
        ]);*/
        if($request->estado==true){
            $estado='A';
        }
       
        //$firma=$request->firma;
        $datos_eval=[
            'usuariows'=>'app',
            'clavews'=>'fa0801',
            'op'=>'editar_evaluador',
            'eval_id'=>$request->codigo,
            'eval_profesion'=>$request->profesion,
            'eval_colegiatura'=>$request->colegiatura,
            'eval_apellidos'=>$request->apellidos,
            'eval_nombres'=>$request->nombres,
            'eval_direccion'=>$request->direccion,
            'eval_telefono'=>$request->telefono,
            'eval_email'=>$request->email,
            'eval_estado'=>'A',
            'eval_idusuario'=>$request->usuario,
            'eval_foto'=>base64_encode(file_get_contents($request->file('firma'))),
            'eval_post_firma'=>$request->postfirma, 
            'trans'=>'I',          
        ];
         //base64_encode(file_get_contents($request->file('firma'))),
        $ch=curl_init();          
        $data=http_build_query($datos_eval);
        curl_setopt($ch,CURLOPT_URL,'http://192.168.1.20/webApiSql/wa/atencion.php');
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $response=curl_exec($ch);
        
        if(curl_errno($ch))$decoded= curl_error($ch);
        else $decoded=json_decode($response,true);

        return $datos_eval + $decoded;
    
    }

    public function evaluador_editar(Request $request, $id){
        $ch=curl_init();
        $datos_edit=[
            'usuariows'=>'app',
            'clavews'=>'fa0801',
            'op'=>'editar_evaluador',
            'eval_id'=>$id,
            'eval_profesion'=>$request->profesion,
            'eval_colegiatura'=>$request->colegiatura,
            'eval_apellidos'=>$request->apellidos,
            'eval_nombres'=>$request->nombres,
            'eval_direccion'=>$request->direccion,
            'eval_telefono'=>$request->telefono,
            'eval_email'=>$request->email,
            'eval_estado'=>'A',
            'eval_idusuario'=>$request->usuario,
            'eval_foto'=>base64_encode(file_get_contents($request->file('firma'))),
            'eval_post_firma'=>$request->postfirma,  
            'trans'=>'E',
            //base64_encode(file_get_contents($request->file('firma'))),          
        ];
            $data=http_build_query($datos_edit);
            curl_setopt($ch,CURLOPT_URL,'http://192.168.1.20/webApiSql/wa/atencion.php');
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

            $response=curl_exec($ch);
            
            if(curl_errno($ch))$decoded= curl_error($ch);
            else $decoded=json_decode($response,true);

            return $decoded + $datos_edit;

    }

    public function modal_evaluador_edit_show($id){
        $ch=curl_init();

        $array=[
            'usuariows'=>'app',
            'clavews'=>'fa0801',
            'op'=>'obtener_evaluador',
            'eval_id'=>$id,

        ];
        $data=http_build_query($array);
        curl_setopt($ch,CURLOPT_URL,'http://192.168.1.20/webApiSql/wa/atencion.php');
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $response=curl_exec($ch);
        
        $evaluadores=json_decode($response,true);

        //usuario 
        $datos['evaluador']= $evaluadores['obtener_evaluador'][0];

        $ch=curl_init();

        $array=[
            'usuariows'=>'app',
            'clavews'=>'fa0801',
            'op'=>'listar_profesion',

        ];
        $data=http_build_query($array);
        curl_setopt($ch,CURLOPT_URL,'http://192.168.1.20/webApiSql/wa/atencion.php');
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $response=curl_exec($ch);
        
        $profesion=json_decode($response,true);
        $datos['profesion']=$profesion['listar_profesion'];

        $cusers=curl_init();
        $array_us=[
            'usuariows'=>'app',
            'clavews'=>'fa0801',
            'op'=>'listar_usuario',
        ];
        $data_us=http_build_query($array_us);
        curl_setopt($cusers,CURLOPT_URL,'http://192.168.1.20/webApiSql/wa/atencion.php');
        curl_setopt($cusers,CURLOPT_POST,true);
        curl_setopt($cusers,CURLOPT_POSTFIELDS,$data_us);
        curl_setopt($cusers,CURLOPT_RETURNTRANSFER,true);

        $response_us=curl_exec($cusers);
        
        $usuarios=json_decode($response_us,true);
        $datos['usuarios']=$usuarios['listar_usuario'];
        
            


        //return $evaluadores['obtener_evaluador'][0];
        return view('frontend.evaluadores.editar_evaluadores')->with('datos',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
