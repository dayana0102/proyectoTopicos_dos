<!-- <template>
  <div>
    <div class="d-flex align-center pa-5">
      <div class="d-flex align-center">
        <v-avatar color="primary" size="56" class="mx-3">EJ</v-avatar>
        <div style="font-size: 20px;">
          Espacio de trabajo de {{ user ? user.name : "" }}
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
                        @keyup.enter="addPanel()"/>
                  </v-card>
                </v-hover>
            </v-col>
            <v-col
              class="px-2"
              cols="12"
              md="3"
              sm="4"
              v-for="(panel, i) in paneles"
              :key="i">
              <v-hover v-slot="{ hover }">
                  <router-link :to="{ name: 'board', params: {id: panel.id} }">
                    <v-card
                      class="table"
                      height="110px"
                      :elevation="hover ? 12 : 2"
                      :class="{ 'on-hover': hover }">
                      <div class="pa-2">{{ panel.name }}</div>
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
import { mapActions, mapGetters, mapState } from "vuex";

export default {
  name: "dash_docente",
  data(){
    return{
      selected: "",
      items:[
        {text:"Todos", value: 0},
        {text:"Cursos", value: 1},
        {text:"Personal", value: 2},
      ]
    }
  },
  computed: {
    ...mapGetters({
      user: "auth/user"
    }),
    ...mapState('docente',['paneles', 'form'])
  },
  methods: {
    ...mapActions('docente', ['addPanel']),
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


</style> -->

<template>
  <div>
    <infopanelesuser />
  </div>
</template>