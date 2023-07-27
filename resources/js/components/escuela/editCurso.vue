<template>
    <v-dialog v-model="dialog" persistent width="600">
      <template #activator="{attrs, on}">
        <v-btn v-bind="attrs" v-on="on" color="teal" @click="asignCurso()" small>
          Editar
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          Editar curso
        </v-card-title>
        <v-card-text class="pb-2">
          <v-form @submit.prevent="editCurso()">
            <v-text-field v-model="form.nombre" label="Nombre"></v-text-field>
            <v-text-field v-model="form.periodo" label="Periodo"></v-text-field>
            <!-- <v-autocomplete v-model="form.docente" label="Docente"></v-autocomplete> -->
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
                :loading="loading"
                type="submit"
                dark
                small>
                Guardar
              </v-btn>
              <v-btn color="error" @click="close()" small >Cancelar</v-btn>
            </v-card-actions>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>    
  
  </template>
  <script>
  import Form from 'vform';
import { mapActions, mapState } from 'vuex';
  
  export default {
    name:"addCurso",
    props:{
      item:{default:{}}
    },
    data(){
      return{
        dialog: false,
        form: new Form ({
          id:"",
          nombre:"",
          periodo:"",
        }),
      }
    },
    computed:{
      ...mapState('escuela', ['loading', 'dialogvuex']),
    },
    methods:{
      ...mapActions('escuela', ['editPanel_escuela', 'getPaneles_escuela']),
      editCurso(){
        this.editPanel_escuela(this.form);
        this.dialog = this.dialogvuex;
        if(!this.dialog){
          this.getPaneles_escuela();
        }
      },
      close(){
        this.dialog = false;
      },
      asignCurso(){
        this.form.keys().forEach(key => {
          this.form[key] = this.item[key];
        });
      }
    }
  }
  
  </script>