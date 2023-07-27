<template>
  <v-dialog v-model="dialog" persistent width="600">
    <template #activator="{attrs, on}">
      <v-btn
        v-bind="attrs"
        v-on="on"
        class="ml-auto mr-4"
        @click="getDocentes_escuela()"
        color="primary">
        Agregar
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        Agregar nuevo curso
      </v-card-title>
      <v-card-text class="pb-2">
        <v-form @submit.prevent="addCurso()">
          <v-text-field v-model="form.nombre" label="Nombre"></v-text-field>
          <v-text-field v-model="form.periodo" label="Periodo"></v-text-field>
          <v-autocomplete
            v-model="form.docente"
            label="Docente"
            :items="docentes"
            item-text="name"
            item-value="id">
          </v-autocomplete>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              :loading="loading"
              type="submit"
              dark
              small>
              Agregar
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
import axios from 'axios'
import { mapActions, mapState } from 'vuex';

export default {
  name:"addCurso",
  data(){
    return{
      dialog: false,
      form: new Form({
        nombre:"",
        periodo:"",
        docente:""
      }),
    }
  },
  computed:{
    ...mapState('escuela', ['dialogvuex', 'loading', 'docentes']),
  },
  methods:{
    ...mapActions('escuela', ['addPanel_escuela', 'getDocentes_escuela']),
    addCurso(){
      this.addPanel_escuela(this.form);
      this.dialog = this.dialogvuex
    },
    close(){
      this.dialog = false;
      this.form.reset();
    }
  }
}

</script>