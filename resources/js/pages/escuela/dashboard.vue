<template>
  <div class="pa-3">
    <v-card class="mb-3">
      <v-card-title>
        Cursos Activos
      </v-card-title>
    </v-card>
    <div class="py-3 px-6">
      <v-row>
        <v-col v-for="panel, i in paneles" :key="i" cols="12" md="3" sm="6" xs="12">
          <!-- <v-alert
            elevation="3"
            height="170"
            border="left"
            colored-border
            color="green accent-4">
            <v-card-title class="px-1 pt-1">
              Comunicación Oral y Escrita
            </v-card-title>
            <v-card-text>
              Docente: Marco de la Cruz Rocca
            </v-card-text>
          </v-alert> -->
          <cursoActivo v-if="panel.estado" :panel="panel"/>
        </v-col>
      </v-row>
    </div>
  </div>
</template>
<script>
import cursoActivo from '~/components/escuela/cursosActivos.vue';
import { mapActions, mapState } from 'vuex';

import Form from "vform";
export default {
  name:"dash_escuela",
  components:{
    cursoActivo
  },
  created(){
    this.getDocentes_escuela();
    this.getPaneles_escuela();
  },
  data() {
    return {
      
    };
  },
  computed: {
    ...mapState("escuela", ['docentes', 'paneles'])
  },
  methods: {
    ...mapActions("escuela", ["getDocentes_escuela", "getPaneles_escuela"]),
  }
};
</script>
