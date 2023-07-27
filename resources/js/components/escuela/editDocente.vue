<template>
    <v-dialog v-model="dialog" persistent width="600">
      <template #activator="{attrs, on}">
        <v-btn
          v-bind="attrs"
          v-on="on"
          color="teal"
          @click="asignarValues()"
          small>
          Editar
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          Editar Docente
        </v-card-title>
        <v-card-text class="pb-2">
          <v-form @submit.prevent="guardarDocentes()">
            <v-text-field v-model="form.name" label="Nombre"></v-text-field>
            <v-text-field v-model="form.dni" label="DNI"></v-text-field>
            <v-text-field v-model="form.telefono" label="Teléfono"></v-text-field>
            <v-text-field v-model="form.email" label="Correo"></v-text-field>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn type="submit" color="primary" small>Guardar</v-btn>
              <v-btn color="error" @click="close()" small>Cerrar</v-btn>
            </v-card-actions>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
  </template>
  <script>
  import Form from "vform";
import { mapActions, mapState } from 'vuex';
  
  export default {
    name: "editDocente",
    props:{
      item: {default:[]}
    },
    data() {
      return {
        dialog: false,
        // loading: false,
        form: new Form({
          id:"",
          name:"",
          dni:"",
          telefono:"",
          email:"",
        })
      };
    },
    computed:{
      ...mapState('escuela', ['loading', 'dialogvuex'])
    },
    methods:{
      ...mapActions('escuela',['editDocentes_escuela', "getDocentes_escuela"]),
      asignarValues(){
        this.form.keys().forEach(key => {
          this.form[key] = this.item[key];
        });
      },
      guardarDocentes(){
        this.editDocentes_escuela(this.form, this.dialog);
        this.dialog = this.dialogvuex
        if (!this.dialog){
          this.getDocentes_escuela()
        }
      },
      close(){
        this.dialog = false;
      }
    }
  };
  </script>
  