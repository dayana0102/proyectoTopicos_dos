<!-- Dialog Editar  -->
<template>
    <div>
      <v-card  @click="showCardDialog = true" class="pa-3" height="auto" :color="data.estado==1?(data.tipo==1?'primary':'warning'):'error'" dark >
        <v-icon small style="float: right; height: 10px; padding-top: 5px;" >mdi-pencil</v-icon> 
        <!-- {{ nametablero }} NOMBRE DEL TABLERO--> 
        {{data.nombre}} 
        <div style="display: flex;">
          <div  style="font-size: 12px; margin-right: 5px;" v-if="attachedFiles.length > 0">
            <v-icon dense  >mdi-attachment </v-icon> {{ attachedFiles.length }}
          </div>
          <div  style=" width: auto;  padding:3px; font-size: 12px;" v-if="datosGuardados" >
            <v-icon  dense> mdi-clock-outline</v-icon> {{ date }}  a las {{ time }} 
          </div>
        </div>
      </v-card>

  <!-- Primer dialog -->
      <v-dialog v-model="showCardDialog" max-width="900">
        <v-container fluid class="fondo-card-edit">
          <v-container>
            <v-row>
              <v-col cols="11" class="pb-3 pt-0">
                <div class="pb-0 mb-4 mt-5 d-flex" >
                  <v-icon class=" pr-3" size="30"> mdi-credit-card-plus-outline </v-icon>
                  <v-textarea 
                    type="text"
                    onfocus="this.select()"
                    v-model="card.name"
                    hide-details
                    auto-grow
                    rows="1"
                    @change="savedatosdesubtareas"
                    :readonly="infopanel.addgrupo?false:true"
                    style="font-size:20px; font-weight:bold ; width:100%"
                   ></v-textarea>
                </div>
                <!--v-card-text class="ml-15 mt-0 pt-0">
                    en la lista 
                    <u>.....  </u>
                </v-card-text-->
              <!-- Vista fecha -->
                <div style="display: flex; align-items: center; margin-left: 15px; " v-if=card.fechalimite >
                  <div style="font-size: 13px; padding-right: 5px;"> 
                    Fecha de vencimiento:
                  </div>
                  <div> 
                    <v-card color="indigo darken-1" dark elevation="0" width="auto" @click="abrirDialogEditar">
                      <span style="font-size: 13px; padding: 3px;"> {{card.fechalimite}} </span>
                    </v-card>
                  </div>
                </div>

              </v-col>   
              <v-col cols="1">
                <v-btn class="close-btn" icon @click="showCardDialog = false">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
              </v-col>
            </v-row>
        </v-container>
  
        <v-container class="pa-0 ma-0 ">
          <v-row class="pa-0 ma-0 " >
            <v-col cols="12" md="9" class="pa-0 ma-0 " >
              <v-container class="pa-0 ma-0 ">
                <v-timeline
                  dense
                  clipped
                  align-top
                  class="pa-0 ma-0 "
                >
               <v-timeline-item
                  fill-dot
                  color="red lighten-2"
                  large
                  class="pa-0 ma-0 mb-8"
                >
                  <template v-slot:icon>
                    <v-icon>mdi-playlist-plus</v-icon>
                  </template>
                  <v-card-title class="pb-0 pt-2 pl-0 ml-0" style="font-size: 17px; font-weight: 500;">
                    Descripción:
                    <v-icon v-if="!editingDescription && infopanel.addgrupo" class="ml-7" @click.stop="startEditingDescription">mdi-pencil</v-icon>
                  </v-card-title>
                  <v-card-text class="ml-0 py-0">
                    <div v-if="infopanel.addgrupo">
                      <v-textarea
                        v-model="card.descripcion"
                        auto-grow
                        outlined
                        color="##757575"
                        rows="2"
                        style="font-size: 15px; "
                        
                      ></v-textarea>
                    </div>
                    <div v-else>
                      <strong>
                        {{ card.descripcion }}
                      </strong>
                    </div>
                  </v-card-text>
                  <div class="justify-align-betweew pl-7" v-if="editingDescription">
                    <v-btn text color="#039BE5" @click="cancelEditingDescription"> Cancelar</v-btn>
                    <v-btn text color="indigo lighten-2" @click="savedatosdesubtareas"> Guardar</v-btn>
                  </div>
                </v-timeline-item>
                <v-timeline-item
                  fill-dot
                  color="#7ea2a5ff"
                  large
                >
                  <template v-slot:icon >
                    <v-icon>mdi-attachment</v-icon>
                  </template>
                  <v-card-title  class="body-1s  pb-0 pt-2 pl-0 ml-0" style="font-size:17px; font-weight: 500 ;" >
                      Recursos
                  </v-card-title>
                  <div>
                    <v-list class="fondo-card-edi">
                      <v-list-item v-for="(file, index) in data.recursos" :key="index">
                        <v-list-item-icon>
                          <v-icon>mdi-file</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                          <v-list-item-title>
                            {{ file.nombre }}   
                            <div v-if="file.texto">
                              <strong v-html="file.texto"></strong>
                            </div>
                            <div v-else>
                              <a :href="file.archivo" target="_blank"> <v-btn color="green"> Descargar</v-btn></a>
                            </div>
                                                   
                            <v-btn v-if="infopanel.addgrupo" @click="deleterecurso(file)" color="error" text class="ml-3" >
                              <v-icon left>mdi-trash-can-outline </v-icon>
                            </v-btn>   
                          </v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                    </v-list>
                    <v-btn text color="primary" @click="openSecondaryDialog('Adjunto')" v-if="attachedFiles.length > 0">Agregar más archivos</v-btn>
                  </div>

                </v-timeline-item>
              </v-timeline>
            </v-container>
          </v-col>

            <!-- colum2 Botones-->
          <v-col cols="12" md="3" v-if="infopanel.addgrupo" >
            <p class="caption pl-3 pb-0 mb-2" >
              <v-icon size="15">mdi-plus</v-icon>
                Añadir tarjeta </p> 
              <div class="ml-5 mb-3">
                <v-btn color="#E8EAF6" elevation="0" class="size-btn" @click="openSecondaryDialog('Adjunto')">
                  <v-icon size="18" class="icon-3">mdi-attachment</v-icon>
                  <div class="text-capitalize"><span class="mayúsculas-texto">Recursos</span></div>
                </v-btn>
                <!--v-btn color="#E8EAF6" elevation="0" class="size-btn" @click="openSecondaryDialog('Fechas')">
                  <v-icon size="18" class="icon-3">mdi-calendar</v-icon>
                  <div class="lowercase-text"><span class="mayúsculas-texto">Fechas</span></div>
                </v-btn-->
              </div>
                <!-- Aciones-->
              <p class="caption mt-4 pl-3 pb-0 mb-2" >
                <v-icon size="15">mdi-shape</v-icon>
                  Acciones
              </p>   
                <div class="ml-5 mb-3">          
                  <v-btn color="#E8EAF6" elevation="0" class="size-btn">
                    <div>
                      <v-btn  class="capitalize-text" :color="data.estado?'error':'green'"  @click="archivarsubtarea()">
                        <v-icon size="18" class="icon-3" >mdi-inbox-arrow-down</v-icon>
                         {{data.estado?'Archivar':'Desarchivar'}}
                      </v-btn>
                    </div>
                  </v-btn> 
                </div>
            </v-col>
          </v-row>
        </v-container>

        <v-container elevation="0"> 
            <v-card v-if="data.addtarea" class="pa-4">
              <v-card-title>
              Sube Tu tarea
              </v-card-title>
              <v-card-text>
                <v-file-input
                label="Elije un archivo"
                v-model="tarea.archivo"
                ></v-file-input>

                <v-textarea
                label="Agrega un comentario"
                v-model="tarea.comentario"
                ></v-textarea>
              </v-card-text>
              <v-card-actions>
                <v-btn 
                color="purple"
                dark
                @click="enviartarea"
                >
                  Enviar
                </v-btn>
              </v-card-actions>
            </v-card>
            <v-card v-else-if="data.entrega " class="pa-4">
                <v-card-title>Tu tarea</v-card-title>
                <strong>Archivo:</strong>
                <a :href="data.entrega.archivo" target="_blank"><v-btn color="green accent-3">Descargar</v-btn></a>
                <div class="ma-2">
                  <span>Comentarios:</span> <br>
                  <span>{{ data.entrega.comentarios }}</span>
                </div>
                <div class="ma-2">
                  <span>Nota:</span> <br>
                  <strong>{{ data.entrega.nota }}</strong>
                </div>
                <v-card-text v-if="!data.entrega.nota">
                  <v-btn small color="error" rounded class="ma-0" @click="eliminar(data.entrega)">Eliminar</v-btn>
                </v-card-text>
            </v-card>
        </v-container>
        <v-container v-if="infopanel.docente && data.tareas.length">
       
          <v-card style="overflow: auto;" >
            <v-card-title>
            Tareas Entregadas
            </v-card-title>
            <v-row v-for="(tarea,i) in data.tareas" :key="i">
              <v-col>
                <v-card elevation="0" class="mx-3">
                  <strong>{{ tarea.nombreuser }}</strong> <br>
                  <span v-if="tarea.comentarios">{{ tarea.comentarios }}</span>
                </v-card>
              </v-col>
              <v-col>
                <a :href="tarea.archivo" target="_blank"><v-btn>Descargar</v-btn></a>
                <v-text-field
                label="Nota"
                v-model="tarea.nota"
                type="number" step="any"
                @change="revisar(tarea)"
                ></v-text-field>
              </v-col>             
            </v-row>
          </v-card>
        </v-container>
      </v-container>
    </v-dialog>

    <!-- Contenido para Miembros -->
    <v-dialog v-model="showSecondaryDialog" v-if="infopanel.addgrupo" max-width="500" >
      <!-- <div v-if="selectedDialog === 'Miembros'">
        <v-container fluid class="fondo-card-edit">
          MIEMBROS DE LA TAREA
          <div>  Lista de miembros: </div>
        </v-container>
      </div> -->

         <!-- Contenido para Adjunto -->
       <div v-if="selectedDialog === 'Adjunto'"> 
        <v-container fluid class="fondo-card-edit">
          <div class="ma-5">
            <v-card-title> ADJUNTAR </v-card-title>
            <v-card-text>
              Agreué recursos 
            </v-card-text>
            <div fluid >
              <v-text-field
              label="Nombre"
              v-model="rec.nombre"
              ></v-text-field>
              <v-select
              :items="[{n:'Archivo',id:1},{n:'Enlace',id:2},{n:'Texto',id:3}]"
              v-model="rec.tipo"
              label="tipo de recurso"
              item-text="n"
              item-value="id"
              ></v-select>

              <v-textarea
              v-if="rec.tipo==3"
              v-model="rec.texto"
              label="Ingrese el texto"
              auto-grow
              :rows="1"
              ></v-textarea>

              <v-textarea
              v-if="rec.tipo==2"
              v-model="rec.texto"
              label="Pegue aqui el enlace"
              auto-grow
              :rows="1"
              ></v-textarea>

              <v-file-input selectedDialog
              v-if="rec.tipo==1"
              v-model="rec.archivo" 
              label="Adjuntar archivos">
              </v-file-input>

            </div>
                     
            <v-layout align-center justify-center>
              <v-btn class="mt-12 justify-content-center mr-5 "  text color="#039BE5" @click="cancelarAdjuntar"> Cancelar</v-btn>
              <v-btn  class="mt-12 justify-content-center ml-5 "  text color="indigo lighten-2" @click="saveAdjuntar"> Guardar</v-btn>
            </v-layout> 
          </div>
        </v-container>
      </div>

      <!-- Sección de fechas -->
      <div>
        <div v-if="selectedDialog === 'Fechas'">
          <v-container fluid class="fondo-card-edit">
            <div class="justify-content-center mx-6 mb-6">
              <v-card-title class="mb-5">FECHAS</v-card-title>
              <div class="row justify-content-center">
                <div class="justify-content-left ml-7">

                  <v-text-field
                  label="Fecha de vencimiento"
                  v-model="card.fechalimite"
                  type="datetime-local"
                  dense
                  ></v-text-field>
                 
                  <v-layout align-center justify-center>
                    <v-btn class="mt-12 justify-content-center mr-5" text color="#039BE5" @click="cancelarFecha">
                      Cancelar
                    </v-btn>
                    <v-btn class="mt-12 justify-content-center ml-5" text color="indigo lighten-2" @click="savedatosdesubtareas">
                      Guardar
                    </v-btn>
                  </v-layout>
                </div>
              </div>
            </div>
          </v-container>
        </div>

        <v-card v-if="savedDate" class="saved-date-card" color="primary">
          <v-card-text class="saved-date-text">{{ savedDate }}</v-card-text>
        </v-card>
      </div>
      </v-dialog>

  <!-- Diálogo de confirmación para eliminar archivo -->
    <v-dialog v-model="confirmationDialog" max-width="500px">
      <v-card>
        <v-card-title>Eliminar Archivo</v-card-title>
        <v-card-text>¿Estás seguro de que deseas eliminar este archivo?</v-card-text>
        <v-card-actions>
          <v-btn color="blue darken-1" text @click="confirmationDialog = false">Cancelar</v-btn>
          <v-btn color="red darken-1" text @click="eliminarArchivo">Eliminar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    </div>
  </template>
  
<script>
import {mapActions} from 'vuex'
import Form from 'vform'
import axios from 'axios';
export default {
  props:{
    data:{default:null},
    infopanel:{default:null},
  },
  data() {
    return {

      card: new Form({
        id:this.data.id,
        name: this.data.nombre,
        descripcion: this.data.descripcion,
        fechalimite:this.data.fecha_limite,
        tipo:this.data.tipo,
      }),
      rec: new Form({
        nombre:'',
        tipo:'',
        archivo:null,
        texto:'',
        id:this.data.id,
      }),

      del: new Form({
        subtarea_id:this.data.id,
        recurso_id:'',
        panel_id:this.infopanel.id,
      }),

      archivarsubt: new Form({
        subtarea_id:this.data.id,
        panel_id:this.infopanel.id,
      }),

    
      tarea: new Form({
        archivo:null,
        comentario:'',
        subtarea_id:this.data.id,
      }),

      revisart: new Form({
        nota:'',
        entrega_id:'',
      }),

      //recursos:this.data.recursos,
      showCardDialog: false,
      editingDescription: false,
      editedDescription: '',
      showSecondaryDialog: false,
      selectedDialog: '', // Seleccionar
      attachedFiles: [],//adjuntar
      newlyAttachedFiles: [] ,// adjuntar nuevo
      confirmationDialog: false, // Estado para mostrar/ocultar el diálogo de confirmación
      fileToDeleteIndex: null, //elimiar archivo
      menufecha: false,
      menuTime: false,
      selectedDialog: 'Fechas', 
      date: '', 
      time: '', 
      reminder: null, 
      reminderOptions:  ['Ninguno', '1 hora antes', '1 día antes', '1 semana antes'], // Opciones de recordatorio
      savedDate: null, 
      datosGuardados: false,         
    };
  },
  methods: {
    startEditingDescription() {
      this.editingDescription = true;
      this.editedDescription = this.card.description;
    },
    cancelEditingDescription() {
      this.editingDescription = false;
      this.editedDescription = '';
    },
    saveEditedDescription() {
      this.card.description = this.editedDescription;
      this.editingDescription = false;
    },
    openSecondaryDialog(dialogName) {
      this.selectedDialog = dialogName;
      this.showSecondaryDialog = true;
    },
    handleFileChange(event) {
      this.attachedFiles = event.target.files;
    },
    cancelarAdjuntar() {
      this.showSecondaryDialog = false; // Cerrar el diálogo sin guardar archivos
      this.attachedFiles = []; // Limpiar 
    },

    ...mapActions('panel',['getinfopanel']),

    saveAdjuntar() {
      this.rec.id=this.data.id;
      this.rec.post('/api/agregar-recurso-tarea').then(response=>{
        this.rec.reset();
        if(response.status==200){
          this.getinfopanel({id:this.infopanel.id});
        }
      })
    
      //this.showSecondaryDialog = false; 
      //this.attachedFiles = this.attachedFiles.concat(this.newlyAttachedFiles); 
      //this.newlyAttachedFiles = [];
    },
    showConfirmationDialog(index) {
      this.fileToDeleteIndex = index;
      this.confirmationDialog = true;
    },
    eliminarArchivo() {
      this.attachedFiles.splice(this.fileToDeleteIndex, 1);
      this.confirmationDialog = false; 
    },
    saveFecha() {
      this.datosGuardados = true;
      this.showSecondaryDialog = false; 
    },
    cancelarFecha() {
      this.editingDescription = false;
      this.showSecondaryDialog=false;
    },
    abrirDialogEditar() {
      this.showSecondaryDialog= true;
      this.selectedDialog='Fechas';
    },

    savedatosdesubtareas(){
      this.card.tipo=this.data.tipo,
      this.card.post('/api/editar-subtarea-grupo').then(response=>{
        if(response.status===200){
          //this.card.reset();
          this.getinfopanel({id:this.infopanel.id});
        }
      })
    },
    deleterecurso(recurso){
      this.del.recurso_id=recurso.id;
      this.del.post('/api/eliminar-recurso').then(response=>{
        if(response.status===200){
          //this.card.reset();
          this.getinfopanel({id:this.infopanel.id});
        }
      })
    },
    archivarsubtarea(){
      if(!confirm('Estas seguro de realizar esta acción?')){
        return
      }
      this.archivarsubt.post('/api/archivar-subtarea').then(response=>{
        if(response.status===200){
          //this.card.reset();
          this.getinfopanel({id:this.infopanel.id});
        }
      })
    },
    enviartarea(){
      this.tarea.subtarea_id=this.data.id;
      this.tarea.post('/api/enviar-tarea').then(response=>{
        this.tarea.reset();
        if(response.status===200){
          this.getinfopanel({id:this.infopanel.id});
        }
      })
    },
    eliminar(tarea){
      this.del.subtarea_id=this.data.id;
      this.del.tarea=tarea.id;
      this.del.post('/api/del-tarea').then(response=>{
        if(response.status===200){
          this.getinfopanel({id:this.infopanel.id});
        }
      })
    },revisar(tarea){
      this.revisart.nota=tarea.nota;
      this.revisart.entrega_id=tarea.id;
      this.revisart.post('/api/revisar-tareas').then(response=>{
        if(response.status===200){
          this.getinfopanel({id:this.infopanel.id});
        }
      })
    }
  },

};
</script>
  
   
  <style>
  .size-btn{
    margin: 0 2px 5px 1px;
    width:145px;
    display: flex;
    flex-direction: column;
    justify-content:left;
  }
  
  .lowercase-text {
    text-transform: lowercase;
    font-size: 13px;
  }
  
  .capitalize-text {
    text-transform: capitalize;
  }
  .icon-3{
    margin-right: 8px; 
    float: left;
  }
  
  .fondo-card-edit{
    height:auto;
    padding: 16px;
    /* background-color: #f1f1f0;  */
    background-color: #f9f9f9;
  }
  
  .close-btn {
    float:right;
    position:fixed;
    margin-top:-20px ;
    margin-right:-20px ;
    color: white;
  }
   
  </style>