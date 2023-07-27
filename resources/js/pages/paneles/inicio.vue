<template>
  <div>
    <div class="d-flex align-center pa-5">
      <div class="d-flex align-center">
        <v-avatar color="primary" size="56" class="mx-3">EJ</v-avatar>
        <div style="font-size: 20px;">
          Espacio de Trabajo de {{ alumno.nombre }}
        </div>
      </div>
    </div>
    <v-divider style="width: 95%;" class="mx-auto my-2"></v-divider>
    <div class="d-flex justify-center">
      <div class="px-4 py-2 containerTablero" style="width: 80%;">
        <h3 class="mb-7">Tableros</h3>
        <div class="d-flex">
          <div>
            <v-card-text class="py-1">Filtrar por:</v-card-text>
            <v-select 
              placeholder="Elegir una Colección"
              outlined
              :items="items"
              v-model="selected"
              :label="items[0].text"></v-select>
          </div>
        </div>
        <div>
          <v-row style="font-size: 17px;">
            <v-col class="px-2" cols="12" md="3" sm="4">
              <v-hover v-slot="{ hover }">
                  <v-card 
                    height="110px" 
                    class="d-flex justify-center align-center py-2 px-3 table"
                    :elevation="hover ? 12 : 2"
                    :class="{ 'on-hover': hover }">
                      <input
                        v-model="form.name"
                        placeholder="Crear tablero nuevo"
                        class="text-center newTable"
                        style="width: 100%;"
                        ref="table"
                        @keyup.enter="addTable()"/>
                  </v-card>
                </v-hover>
            </v-col>
            <v-col
              class="px-2"
              cols="12"
              md="3"
              sm="4"
              v-for="(table, i) in tables"
              :key="i">
              <v-hover v-slot="{ hover }">
                  <router-link :to="{ name: 'board', params: {id: table.id} }">
                    <v-card
                      class="table"
                      height="110px"
                      :elevation="hover ? 12 : 2"
                      :class="{ 'on-hover': hover }">
                      <div class="pa-2">{{ table.name }}</div>
                    </v-card>
                  </router-link>
              </v-hover>
            </v-col>
          </v-row>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// import panelCurso from "./board.vue";
import form from "vform"

export default {
  name: "panelAlumno",
  data() {
    return {
      tables: [ //CURSOS: 1 - PERSONAL: 2
        {id:1, name: "Algoritmos", type:1 },
        {id:2, name: "Calculo Diferencial", type:1 },
        {id:3, name: "Matemática Básica", type:1 },
        {id:4, name: "Comunicación Oral y Escrita", type:1 },
        {id:5, name: "Matemática Superior", type:1 },
        {id:6, name: "Fisica General", type:1 }
      ],
      alumno: {
        nombre: "Eduardo Jesús Cruz Matías"
      },
      form: new form({
        name:"",
      }),
      selected: "",
      items:[
        {text:"Todos", value: 0},
        {text:"Cursos", value: 1},
        {text:"Personal", value: 2},
      ]
    };
  },
  methods:{
    addTable(){
      this.tables.push({id: this.tables.length + 1,name: this.form.name, type:2})
      this.form.name =""
      // this.$refs.table.blur();
      
    },
    traerpanel(){
      axios.get()
    }
  },
};
</script>
<style>
.titulo {
  height: 50px;
  width: 100%;
  background-color: #ffffffaf;
}

.table{
  cursor: pointer;
}

.table {
  transition: opacity .4s ease-in-out;
}

a {
    text-decoration: none;
}

.table:not(.on-hover) {
  opacity: 0.7;
 }


.newTable:focus, .newTable:active{
  outline: none !important;
}

@media (max-width: 1330px) {
  .containerTablero {
    width: 100% !important;
  }
}

/*  */
</style>
