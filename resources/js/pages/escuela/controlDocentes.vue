<template>
  <div class="pa-3">
    <v-card class="d-flex align-center mb-3">
      <v-card-title>Docentes</v-card-title>
      <add-docente />
    </v-card>
    <v-card>
      <v-card-text>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Buscar"
          single-line
          hide-details
        ></v-text-field>
      </v-card-text>
      <v-data-table :headers="headers" :search="search" :items="docentes_view">
        <template #[`item.actions`]="{item}">
            <edit-docente :item="item"/>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
<script>
import addDocente from "~/components/escuela/addDocente.vue";
import editDocente from "~/components/escuela/editDocente.vue";
import { mapState, mapActions } from 'vuex';

export default {
  name: "controlDocente",
  components: {
    addDocente,
    editDocente
  },
  created(){
    this.getDocentes_escuela();
  },
  data() { 
    return {
      headers: [
        { text: "Nombre", value: "name" },
        { text: "DNI", value: "dni" },
        { text: "Teléfono", value: "telefono" },
        { text: "Correo", value: "email" },
        { text: "Acción", value: "actions" }
      ],
      search: "",
    };
  },
  computed:{
    ...mapState('escuela', ["docentes_view"]),
  },
  methods:{
    ...mapActions("escuela", ["getDocentes_escuela"]),
  }
};
</script>
