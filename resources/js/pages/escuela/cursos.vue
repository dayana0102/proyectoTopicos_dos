<template>
  <div class="pa-3">
    <v-card class="d-flex align-center mb-3">
      <v-card-title>
        Cursos de Escuela
      </v-card-title>
      <add-curso/>
    </v-card>
    <v-card>
      <v-data-table :headers="headers" :items="paneles_view">
        <template #[`item.actions`]="{item}">
          <edit-curso :item="item"/>
        </template>
        <template #[`item.docente`]="{item}">
          {{ item.docentes[0].name }}
        </template>
        <template #[`item.estado`]="{ item }">
          <v-switch
            color="primary"
            elevation="0"
            :input-value="item.estado"
            @click="cambiarEstado_panel(item)">
          </v-switch>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
<script>
import Form from 'vform';
import editCurso from '~/components/escuela/editCurso.vue';
import addCurso from '~/components/escuela/addCurso.vue';
import { mapActions, mapState } from 'vuex';

export default {
  name: "controlCursos",
  components:{
    editCurso,
    addCurso
  },
  created() {
    this.getPaneles_escuela();
  },
  data() {
    return {
      headers:[
        {text:"Nombre", value:"nombre"},
        {text:"Código", value:"codigo"},
        {text:"Periodo", value:"periodo"},
        {text:"Docente", value:"docente"},
        {text:"Estado", value:"estado"},
        {text:"Acciones", value:"actions"},
      ],
    };
  },
  computed:{
    ...mapState('escuela', ['paneles_view'])
  },
  methods: {
    ...mapActions('escuela', ['getPaneles_escuela', 'changeEstado_panel']),
    cambiarEstado_panel(item){
      this.changeEstado_panel(item);
    }
  }
};
</script>
