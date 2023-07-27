<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class documentocontroller extends Controller
{
    
    protected function descargar_fut(Request $request){
        //$user=$request->user();
        //$persona=Persona::where('id',$user->persona_id)->first();
        $usuario=$request;
        $pdf = PDF::loadView('fut.fut',['usuario'=>$usuario]);
        $pdf->setPaper('A4', 'portraite');
        
       // Response::header('Content-type', 'application/pdf');
        //$pdf->stream('fut.pdf',array('attachment' => false));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'fut.pdf');
        exit();
    }


    protected function descargar_reporte(Request $request){
        $tramite=$request->tramite;
        $pdf = PDF::loadView('reporte.tramite',['tramite'=>$tramite]);
        $pdf->setPaper('A4', 'portraite');
        
       // Response::header('Content-type', 'application/pdf');
        //$pdf->stream('fut.pdf',array('attachment' => false));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'fut.pdf');
        exit();
    }
}
