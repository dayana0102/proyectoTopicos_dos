<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            margin: 0;
            padding: 0;
        }

   
        #reporte{
            margin-left:15px ;
            margin-right:15px ;

        }

        #reporte{
            font-family: Helvetica, Arial, sans-serif;
        }
        .encabezado{
          text-align: center;
          width:90%;
          float:left; 
          font-size: 20px;
          margin-top:-20;
          padding-top:0;
          line-height: 10px;
      }
      .logo-undac{
        width:60px ;
        margin-top:0;
      }

      .datostitulo{
        font-size:10px;
        padding-top:0px;
        margin-top:0px ;
        margin-bottom:0px;
        font-weight: bold;   
        font-family: Arial, Helvetica, sans-serif;
        height:12px;
        
      }

      .datosrespuesta{
        font-size:10px;
        line-height: 1px;
        padding-top:0px;
        font-family: Arial, Helvetica, sans-serif;
      }

      .borde{
        border-bottom: 1px solid #999;
        border-color:#bfbfbf;
        padding-top:7px;
        padding-bottom:7px;
      }



      
      

</style>

<div id="reporte">
    
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:-20px;" >
            <!-- encabezado -->
            <tr >
                <td class="encabezado" colspan="3" style="padding-bottom:15px;">
                    <img src="img/u.png" alt="" class="logo-undac" style="float:left; ">
                    <p style=" font-weight: bold; ">UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRIÓN</p> 
                    <p>Información del tramite</p>
                    
                </td>
            </tr>
             <!-- datos del alumno -->
            <tr>
                <td style="width:180px;" > 
                    <p class="datostitulo" >Nombre completo:</p>
                    <p class="datosrespuesta" >{{$tramite['per_nom']}}</p>
                </td>
                <td style="width:140px; padding-left:15px;"> 
                    <p class="datostitulo">Código del alumno:</p>
                    <p class="datosrespuesta">{{$tramite['cod_alumno']}}</p>
                </td>
                <td style="width:80px; padding-left:15px;">
                    <p class="datostitulo">Año de egreso:</p>
                    <p class="datosrespuesta">{{$tramite['egreso']}}</p>

                </td>
            </tr>

            <tr>
                <td style="width:180px;" > 
                    <p class="datostitulo">Nombre del tramite:</p>
                    <p class="datosrespuesta">{{$tramite['tramite']}}</p>

                </td>
                <td style="width:140px; padding-left:15px;"> 
                    <p class="datostitulo">Grado:</p>
                    <p class="datosrespuesta">{{$tramite['grado']}}</p>
                </td>
                <td style="width:80px; padding-left:15px;">
                    <p class="datostitulo">Obtención mediante:</p>
                    <p class="datosrespuesta">{{$tramite['obtencion']}}</p>

                </td>
            </tr>

            <tr>
                <td style="width:180px;" > 
                    <p class="datostitulo">Facultad:</p>
                    <p class="datosrespuesta">{{$tramite['facultad']}}</p>
                </td>
                <td style="width:140px; padding-left:15px;"> 
                    <p class="datostitulo">Escuela Profesional:</p>
                    <p class="datosrespuesta">{{$tramite['escuela']}}</p>
                </td>
                <td style="width:80px; padding-left:15px;">
                    <p class="datostitulo">Fecha de inicio del tramite:</p>
                    <p class="datosrespuesta">{{$tramite['fecha_inicio']}}</p>

                </td>
            </tr>

            <tr >
                <td style="width:180px;" > 
                    <p class="datostitulo">Fecha final del tramite:</p>
                    <p class="datosrespuesta">{{$tramite['fecha_final']}}</p>
                </td>
                <td style="width:140px; padding-left:15px;"> 
                    <p class="datostitulo">Total de fases del tramite:</p>
                    <p class="datosrespuesta">{{$tramite['total_fases']}}</p>
                </td>
                <td style="width:80px; padding-left:15px;">
                    <p class="datostitulo">Duración del tramite:</p>
                    <p class="datosrespuesta">{{$tramite['duracion']}}</p>
                </td>
            </tr>

            <tr>
                <td style="width:180px;"> 
                    <p class="datostitulo">Modalidad:</p>
                    <p class="datosrespuesta">{{$tramite['modalidad']}}</p>
                </td>
                <td style="width:140px; padding-left:15px;"> 
                    <p class="datostitulo">Participantes:</p>
                    <p class="datosrespuesta">{{$tramite['numero_participantes']}}</p>
                </td>
                <td style="width:80px;">
                    <p></p>
                </td>
            </tr>
        </table>
    <br>
    <!-- cuadro de fases -->

    <div class="fases">
        <table id="tabla1" border="0" cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr style="background:#eee; color:#64647C; font-size:13px; font-family: Verdana, Arial, Helvetica, sans-serif; line-height: 125%; ">
                    <th class="borde" style="padding:7px;font-weight: lighter;" >
                        Nº Fase
                    </th>
                    <th class="borde" style="padding:7px;font-weight: lighter;" >
                        Doc observados
                    </th>
                    <th class="borde" style="padding:7px;font-weight: lighter;" >
                        Doc aprobados 
                    </th>
                    <th class="borde" style="padding:7px; font-weight: lighter;">
                        Otras observaciones
                    </th>
                    <th class="borde" style="padding:7px;font-weight: lighter;">
                        Fecha inicio y fin
                    </th>
                    <th class="borde" style="padding:7px;font-weight: lighter;">
                        Duración dias
                    </th>
                </tr>
            </thead>
            <tbody style="text-align: center; font-size:10.5px; color:#383849">
                @foreach( $tramite['fases'] as $fase)
                <tr >
                    <td class="borde" >{{$fase['numero']}}</td>
                    <td class="borde">{{$fase['observacion']}}</td>
                    <td class="borde">{{$fase['aprobados']}}</td>
                    <td class="borde">
                        @if(count($fase['otros'])>0)
                        <div style="text-align: left;">
                            @foreach($fase['otros'] as $otro)
                            <div >
                                <span style="font-size:10.5px; font-weight: bold;padding-left:10px" >{{$otro['NOMBRE']}}</span>
                                @if($otro['VALOR']=='GAME_OVER_TRAMITE')
                                    <span style="font-size:10.5px;padding-right:10px; " >Tramite terminado</span>
                                @endif
                                    <span v-else style="font-size:10.5px;padding-right:10px;" >{{$otro['VALOR']}}</span>                     
                            </div>
                            @endforeach
                        </div> 
                        @endif
                    </td>
                    <td class="borde">
                        <span style="font-size:10px;">{{$fase['fecha_inicio']}}</span>
                        <br>
                        <span style="font-size:10px;">{{$fase['fecha_fin']}}</span>
                        
                    </td>
                    <td class="borde">{{$fase['duracion']}}</td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</body>
</html>