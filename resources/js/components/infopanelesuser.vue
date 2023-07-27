<template>
  <div v-if="user">

    <div class="row justify-content-space-between align-center mt-3 pa-5">
      <div style="display: flex; align-items: center; margin-left:40px;">
        <v-avatar color="primary" size="56" class="mx-3">EJ</v-avatar>
        <div style="font-size: 20px;">
          Espacio de Trabajo de {{ user.name }}
        </div>
      </div>
      <div style="position: absolute; right: 40px;">
        <v-btn
          class="ma-2"
          outlined
          color="#01579B"
          @click="UnirseTablero = true"
        >
          <v-icon>mdi-plus</v-icon> UNIRSE A UN TABLERO
        </v-btn>
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
                      :color="table.tipo==1?'primary':''"
                      class="table"
                      height="110px"
                      :elevation="hover ? 12 : 2"
                      :class="{ 'on-hover': hover }">
                      <div class="pa-2">{{ table.nombre}}</div>
                    </v-card>
                  </router-link>
              </v-hover>
            </v-col>
          </v-row>
        </div>
      </div>
    </div>

<!-- UNIRSE AL TABLERO DIALOG -->

<v-dialog v-model="UnirseTablero" width="47%">
  <v-container fluid class="bg-cardpg">
    <v-card elevation="0">
      <div class="ma-4">
        <v-btn class="close-btn" icon @click="UnirseTablero = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
        <v-card-title style="font-size:30px; color:#01579B "> UNIRSE A UN TABLERO</v-card-title>
      </div>
      <v-divider></v-divider>
      <div class="pl-10 pr-10">
        <v-card-text>
          <p style="font-weight: bold; font-size: 20px; margin-bottom: 8px; color: #0277BD">
            Código del tablero</p>

          <br /> Pídele a tu profesor el código de la clase y, luego, ingrésalo aquí.
        </v-card-text>
        <div class="row justify-content-center" style=" margin-left: 15px; margin-top: 15px; ">
          <div class="justify-content-center" style="width: 300px;"> 
            <v-text-field 
              class="ma-0 pa-0"
              v-model="formmatricula.codigo" 
              label="Codigo del tablero" 
              outlined 
              clearable
              color="#0277BD"
              ></v-text-field>
          </div>

          <div class="justify-content-center" style="margin-left: 70px;" > 
            <v-btn 
            class="ma-1"
            color="#0277BD"
            plain
            x-large
            :disabled="!formmatricula.codigo"
            @click="matricularse()"
            > UNIRSE  </v-btn>
            
          </div>

        </div>
        <v-card-text >
          Para acceder con un código de la clase
          <v-list>
            <v-list-item>
              <v-icon color="#0277BD">mdi-circle-medium</v-icon>
              Usa una cuenta autorizada.
            </v-list-item>
            <v-list-item>
              <v-icon color="#0277BD">mdi-circle-medium</v-icon>
              Usa un código de la clase que tenga 5 letras o números, sin espacios ni símbolos.
            </v-list-item>
          </v-list>
        </v-card-text>
      </div>
    </v-card>
  </v-container>
</v-dialog>


  </div>
  
</template>

<script>

import { mapGetters,mapActions } from 'vuex';
import Form from "vform";
export default {
  name: "infopanelesuser",
  
  data() {
    return {
      alumno: {
        nombre: "Eduardo Jesús Cruz Matías"
      },
      form: new Form({
        name:"",
      }),
      selected: "",
      items:[
        {text:"Todos", value: 0},
        {text:"Cursos", value: 1},
        {text:"Personal", value: 2},
      ],
      UnirseTablero: false,
      CodigoTablero: "",
      
      formmatricula: new Form({
        codigo:'',
      })
    };
  },

  computed:{
    ...mapGetters({
      tables:'panel/paneles',
      user:'auth/user',
    })
  },
  methods:{
      ...mapActions('panel',["getpaneles"]),
      addTable(){
        this.form.post('/api/agregar-tablero').then(response=>{
          this.$store.dispatch("panel/getpaneles");
          this.form.reset();
        })
      },
      matricularse(){
        this.formmatricula.post('/api/matricularse').then(response=>{
          this.$store.dispatch("panel/getpaneles");
        })
      }
  },
  mounted() {
    this.getpaneles();
  },
};
</script>

<style>
.titulo {
  height: 50px;
  width: 100%;
  background-color: #ffffffaf;
}

.bg-cardpg{
    height:auto;
    padding: 16px;
    /* opacity: 0.9; */
    background-color:#ffffff;
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


</style>