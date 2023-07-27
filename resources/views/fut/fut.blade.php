
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
</head>
<body>
  <style>
      @font-face {font-family: "English111 Vivace BT"; 
     /* src: url("//db.onlinewebfonts.com/t/6f6b892a1bd21758d3ce6fe690976ec3.eot"); */
      src: local('English111 Vivace BT') ,   
      url("/6f6b892a1bd21758d3ce6fe690976ec3.ttf") format("truetype");
      }
      @page{
          margin: 30px;
          margin-left:110px;
          margin-right:110px;
          padding:0;
          background:rgb(7, 7, 11);

      }
      .page-break{
          page-break-after: always;
      }
      .img_fondo{
       opacity: 0.5;
       position: absolute;
       width: 500px;
       top: 150;
       left: 50;
       right: 0;
       bottom: 0;
       margin: auto;
       z-index: -4;
      }
      .logo-undac{
        width:55px ;
        float:left; 

      }
      .encabezado{
          text-align: center;
          width:90%;
          float:left; 
          font-size: 18px;
          font-weight: bold;    
          margin-top:0;
          padding-top:0;
      }
      .encabezado p{
        margin:0;
        padding:0;
        justify-content: start;
        text-align: center;
        
      }
      .titulo{
        font-size:10px;
        padding-top:1px;
        margin-top:2px;
        font-weight: bold;   
        font-family: Arial, Helvetica, sans-serif;
      }
      .respuesta{
        margin:0;
        font-weight: none;   
        font-size:12px; 
        margin-bottom:0px;
        font-family: Arial, Helvetica, sans-serif;
        padding-left:13px;        
      }

      .linea{
        border-bottom: 1px  dotted ;
        margin:0px;
        margin-top:0px
      }

      .margen{
        height:40px;
        vertical-align:bottom;
      }
      .margen-b{
        height:25px;
        vertical-align:bottom;
      }
      

  </style>

  <div >
    <img class="img_fondo" src="img/fondo_fut.png" alt="">
    <img src="img/u.png" alt=""  class="logo-undac">

    <div class="encabezado" >
       <p>UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRIÓN</p> 
       <p>FORMULARIO ÚNICO DE TRÁMITE</p> 
    </div>
      <hr style="margin-top:62px;">
 
      <table width="100%" >
        <tbody>
          <tr style="margin-top:60px; ">
            <td style="width:340px;" ></td>
              <div style="text-align:initial; font-weight: bold; font-size:12px;
              width:210px;font-family: Arial, Helvetica, sans-serif;
              height:70px; padding-top:15px;">
                SOLICITO: 
                <span style="width:145px; padding-left:10px; line-height: 20px; text-align: justify " class="respuesta" >
                  {{$usuario['sumilla']}} </span>
              </div>
          </tr>
        </tbody>
      </table>

      <table width="100%"  >
        <tbody>
          <tr >
            <td style="width:340px;" ></td>
            <td colspan="2"  style="text-align:left; width:209px; font-weight: bold;">
              <p class="titulo"> 1.  SUMILLA</p> 
            </td>
          </tr>

          <tr  >
            <td colspan="3" class="margen">
              <div class="linea" >
              <p class="respuesta">{{$usuario['destinatario']}}</p></div>
              <p class="titulo">2. DESTINATARIO</p> 
            </td>
          </tr>

          <tr>
            <td colspan="3" class="margen">
              <div class="linea" >
              <p class="respuesta">{{$usuario['nombre']}}</p></div>
              <p class="titulo">3. DATOS DEL USUARIO (APELLIDOS Y NOMBRES ) </p>
            </td>
          </tr>

          <tr>
            <td colspan="3" class="margen" >
              <div class="linea" >
              <p class="respuesta">{{$usuario['cargo']}}</p></div>
              <p class="titulo">4. CARGO ACTUAL Y/O CENTRO DE TRABAJO </p>
            </td>
          </tr>
          </tbody>
      </table>

      <table width="100%" >
        <tbody>
          <tr>
            <td class="margen" style="width:250px;">
              <div class="linea"> 
                <p class="respuesta" >{{$usuario['dni']}}</p></div>
                <p class="titulo">5. D.N.I </p>  
            </td>

            <td class="margen" style=" padding-left:8px; ">
              <div  class="linea">
                <p class="respuesta" >{{$usuario['codigo']}}</p></div>
                <p class="titulo"> 6. CÓDIGO DE MATRíCULA </p>               
            </td>
          </tr>

          <tr>
            <td class="margen">
              <div class="linea">
                <p class="respuesta">{{$usuario['telefono']}}</p></div>
                <p class="titulo">7. N° CELULAR/TELF.</p> 
            </td>

            <td class="margen" style=" padding-left:8px;">
                <div class="linea">
                <p class="respuesta" >{{$usuario['correo']}}</p></div>
                <p class="titulo">8. CORREO ELECTRÓNICO</p> 
            </td>
          </tr>
          </tbody>
      </table>

      <table width="100%"  >
        <tbody>
          <tr>
            <td class="margen" style="width:120px">
              <div class="linea">
                <p class="respuesta" style="font-size:10.5px; " >{{$usuario['facultad']}}</p></div>
                <p class="titulo" > 9. FACULTAD </p> 
            </td>

            <td class="margen" style="width:130px; padding-left:8px; padding-right:8px;">
              <div class="linea" >
              <p class="respuesta" style="font-size:10.5px; text-align:center; padding-left:0px;" >{{$usuario['escuela']}}</p></div>
              <p class="titulo" style="text-align:center;" >ESCUELA PROFESIONAL</p> 
            </td>

            <td class="margen" style="width:130px">
              <div class="linea">
              <p class="respuesta" style="font-size:10.5px; text-align:center; padding-left:0px;" >{{$usuario[' ']}}</p></div>
              <p class="titulo" style="text-align:center;" >ESPECIALIDAD</p>
            </td>
          </tr>
          </tbody>
      </table>

      <table width="100%"  >
        <tbody>
          <tr>
            <td class="margen">
              <div class="linea">
              <p class="respuesta">{{$usuario['direccion']}}</p></div>
              <p class="titulo">10. DOMICILIO DEL USUARIO (Calle, Distrito, Provincia Y Región) </p> 
            </td>
          </tr>
          <tr>
            <td class="margen">
              <div class="linea" style="padding-top:15px;" ></div>
              <p class="titulo">11. FUNDAMENTACIÓN DEL PEDIDO </p>             
              <div style="height:160px; line-height: 20px; text-align: justify ">
                <p class="respuesta"> {{$usuario['cuerpo']}}</p>
              </div>
            </td>
          </tr>
          </tbody>
      </table>

      <table width="100%" >
        <tbody>
          <tr>
            <td rowspan="2"  style="width: 340px; vertical-align: text-top; padding-top:5px;"  >
              <p class="titulo"> 12. ANEXO.</p>
              <p class="respuesta" style=" padding-left:15px; line-height: 20px; text-align: justify " >  {{$usuario['anexo']}}</p>
            </td>

            <td style=" vertical-align: text-top;">
              <div class="titulo" style=" float:left;">13. FECHA:</div>
                <div class="linea" style="width:165px;  margin-left:auto"; >
                  <span class="respuesta">  {{$usuario['fecha']}} </span>
              </div>
            </td>
          </tr>

          <tr>
            <td class="margen">
              <div class="titulo" >14. FIRMA: 
                <div class="linea" style="width:165px;  margin-left:auto"; ></div>
              </div>
            </td>
          </tr>

        </tbody>
      </table>
      <br>
      <hr>

      <table width="100%">
        <tbody class="margen">
          <tr>
            <td colspan="2" class="margen-b">
                <div class="titulo" style=" float:left;"> FUNDAMENTACIÓN DEL PEDIDO: </div> 
                  <div class="linea" style="width:402px; margin-left:4px; float:left;" >
                  <span class="respuesta" >  {{$usuario['sumilla']}} </span> </div>
            </td>
          </tr>

          <tr>
            <td class="margen-b" style="width:420px; ">
                <div class="titulo" style=" float:left;" >APELLIDOS Y NOMBRES:</div>
                  <div class="linea" style="width:285px;  margin-left:4px; float:left;" >
                  <span class="respuesta">{{$usuario['nombre']}}</span> </div>
            </td>
            <td class="margen-b">
              <div class="titulo" style=" float:left;">FOLIO: 
                <span class="linea" style="width:105px; margin-top:13px; margin-left:40px; float:left;"></span>
              </div>
            </td>
          </tr>
          <tr>
            <td class="margen-b" >
              <div class="titulo" style=" float:left; ">  N° DE REGISTRO:  </div>
                <div class="linea" style="width:320px;  margin-top:15px; margin-left:4px; float:left;"; ></div>
            </td>
            <td class="margen-b">
              <div class="titulo" style=" float:left;" >FECHA: </div>
              <div class="linea" style="width:105px;  margin: left -81px;float:left;"; >
              <span class="respuesta"> {{$usuario['fecha']}}</span></div>
              
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" >
        <tbody>
          <tr>
            <td class="margen-" style="width:120px">
              <div class="linea">
                <p class="respuesta" style="font-size:10.5px; text-align:center; padding-left:0px;">{{$usuario['facultad']}}</p></div>
                <p class="titulo" style="text-align:center;">FACULTAD </p> 
            </td>

            <td class="margen" style="width:130px; padding-left:8px; padding-right:8px;">
              <div class="linea" >
              <p class="respuesta" style="font-size:10.5px; text-align:center; padding-left:0px;">{{$usuario['escuela']}}</p></div>
              <p class="titulo" style="text-align:center;">ESCUELA PROFESIONAL</p> 
            </td>

            <td class="margen" style="width:130px">
              <div class="linea">
              <p class="respuesta" style="font-size:10.5px; text-align:center; padding-left:0px;">{{$usuario[' ']}}</p></div>
              <p class="titulo" style="text-align:center;">ESPECIALIDAD</p>
            </td>
          </tr>
          </tbody>
      </table>

  </div>
</body>
</html>
