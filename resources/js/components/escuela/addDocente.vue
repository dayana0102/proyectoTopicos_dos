<template>
  <v-dialog v-model="dialog" persistent width="600">
    <template #activator="{attrs, on}">
      <v-btn 
        v-bind="attrs"
        v-on="on"
        color="primary"
        class="ml-auto mr-4">
        Agregar
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
     
        Agregar Docente
      </v-card-title>
      <v-card-text class="pb-2">
        <v-form @submit.prevent="addDocente()">
          <v-text-field v-model="form.nombre" label="Nombre"></v-text-field>
          <v-text-field v-model="form.dni" label="DNI"></v-text-field>
          <v-text-field v-model="form.telefono" label="Teléfono"></v-text-field>
          <v-text-field v-model="form.correo" label="Correo"></v-text-field>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              type="submit"
              color="primary"
              :loading="loading"
              small>Agregar</v-btn>
            <v-btn
              color="error"
              @click="close()"
              small>Cerrar</v-btn>
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
  name: "addDocente",
  data() {
    return {
      dialog: false,
      // loading: false,
      form: new Form({
        nombre:"",
        dni:"",
        telefono:"",
        correo:"",
      })
    };
  },
  computed:{
    ...mapState('escuela', ['loading','dialogvuex']),
  },
  methods: {
    ...mapActions('escuela', ['addDocentes_escuela']),

    addDocente(){
      this.addDocentes_escuela(this.form);
      this.dialog=this.dialogvuex;
    },
    close(){
      this.dialog = false;
      this.form.reset();
    }
  }
};
</script>
