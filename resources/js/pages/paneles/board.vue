<template>
  <div style="height: 100%;" class="pa-2">
    <div class="py-2 px-3 d-flex align-center headerBoard">
      <!-- <div style="height: 100%;" class="d-flex align-center"> -->
        {{ add_nombre }}
      <input
        class="titleStyle titlesize focus"
        v-model="forms.nameTable"
        onfocus="this.select()"
        @keyup.enter="changeTitle()"
        @keyup.escape="$refs.input.blur()"
        ref="input"
        readonly
      />
        <v-chip color="warning" v-if="infopanel">
          {{ infopanel.dueño?'Dueño':infopanel.docente?'Docente':'Alumno' }}
        </v-chip>
        <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-width="200"
        offset-x
        v-if="infopanel.alumno"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="indigo"
              dark
              v-bind="attrs"
              v-on="on"
              small
              class="mx-4"
            >
              Datos del docente
            </v-btn>
          </template>
          <v-card v-if="infopanel.datodocente">
            <v-list>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>{{ infopanel.datodocente.name }}</v-list-item-title>
                <v-list-item-subtitle>Correo:{{ infopanel.datodocente.email }}</v-list-item-subtitle>
                <v-list-item-subtitle>Telefono:{{ infopanel.datodocente.telefono }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            </v-list>
          </v-card>
        </v-menu>
        <v-menu
        v-model="menu2"
        :close-on-content-click="false"
        :nudge-width="200"
        offset-x
        v-if="infopanel.integrantes.length>1"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              dark
              v-bind="attrs"
              v-on="on"
              small
              class="mx-4"
            >
              integrantes
            </v-btn>
          </template>
          <v-card >
            <v-list>
              <v-list-item v-for=" (inte,i ) in infopanel.integrantes" :key="i" v-show="inte.alumno">
                <v-list-item-content >
                  <v-list-item-title>{{ inte.nombre }}</v-list-item-title>
                  <v-list-item-subtitle>Correo:{{ inte.email}}</v-list-item-subtitle>
                  <v-list-item-subtitle>Telefono:{{ inte.telefono }}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card>
        </v-menu>
     <!-- <div v-for="(table, i) in title"
              :key="i">
      {{ table.title }} hol
     </div> -->
      <!-- </div> -->
    </div>
    <div class="py-4 px-3 overflow-x-auto container_lists">
      <div class="d-flex">
        <div v-for="(list, i) in lists" :key="i">
          <worklist :data="list" />
        </div>
        <div>
          <div v-if="infopanel &&infopanel.addgrupo"
            class="mx-3 new_workList pa-3"
            :style="activeInput ? 'background-color: #ffffffc6' : 'background-color: #ffffff7d'"
            >
            <div
              @click="showInput()" 
              v-if="!activeInput"
              class="d-flex align-center"
              style="cursor: pointer;">
              <div><v-icon>mdi-plus</v-icon></div>
              <div class="pa-1" style="color: #172b4d;">Añada otra lista</div>
            </div>
            <div v-else>
              <div class="pb-3" style="height: 28px;">
                <input
                  v-model="forms.nameList"
                  type="text"
                  class="titleStyle addlist"
                  ref="newlist"
                  @keyup.escape="activeInput= false"
                  @keyup.enter="addNewList()">
              </div>
              <div class="d-flex align-center pt-2">
                <v-btn
                  color="primary"
                  elevation="0"
                  x-small
                  class="mr-1"
                  @click="addNewList()">
                    Añadir Lista
                </v-btn>
                <div>
                  <v-icon @click="activeInput = false">mdi-close</v-icon>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Form from "vform";
import worklist from "./components/worklist.vue";
import { mapGetters,mapActions } from "vuex";
export default {
  name: "board",
  components: {
    worklist
  },
  
  data() {
    return {
      forms: new Form({
        nameTable: '',
        nameList: '',
        idtable:'',
      }),
      lists: [],
      activeInput: false,
      id:this.$route.params.id,
      title:'',
      menu:false,
      menu2:false,
    };
  },
  computed:{
    ...mapGetters({
      infopanel:'panel/infopanel',
    }),
    add_nombre(){
      this.forms.nameTable=this.infopanel?.nombre;
      this.forms.idtable=this.infopanel?.id;
      this.lists=this.infopanel?.grupos;
    }
  },
  methods: {
    getStudents() {
      this.forms.nameTable = this.data.name;
    },
    changeTitle(){
      this.addNewList();
    },
    showInput() {
      this.activeInput = true;
      this.$nextTick(() => {
        this.$refs.newlist.focus();
      });
    },
    addNewList(){
      this.forms.post('/api/add-grupo-panel').then(response=>{
        this.forms.reset();
        this.obtenerinfo();
      }).catch(error=>{

      })
    },

    ...mapActions('panel',['getinfopanel']),

    async obtenerinfo(){
      await this.getinfopanel({id:this.$route.params.id});
    }
  },
  created() {
    this.obtenerinfo();
  }
};
</script>
<style>
.headerBoard {
  position: relative;
  background-color: #ffffff97;
  height: 8%;
}

.titlesize {
  min-width: 120px;
  height: 100%;
  font-size: 18px;
  font-weight: 600;
  padding: 10px 0;
  text-align: center;
}

.titleStyle {
  color: #172b4d;
  border-radius: 3.5px;
}

.titleStyle:focus,
.titleStyle:active {
  outline: #388bff;
  border: solid #388bff 2.5px;
  background-color: #ffffff;
}

.titleStyle::selection {
  background-color: #3390ff;
  color: #ffffff;
}

.new_workList {
  min-width: 272px;
  border-radius: 10px;
  background-color: #ffffffc6;
  background-color: #ffffff7d;
  flex-grow: 0;
  font-size: 14px;
  font-weight: 400;
}


.container_lists {
  display: flex;
  flex-direction: row;
  width: 100%;
  /* height: 92%; */
}

.addlist{
  width: 100%;
  padding: 2px 5px;
}

.container_lists::-webkit-scrollbar {
  width: 5px;
  height: 10px;
}
.container_lists::-webkit-scrollbar-thumb {
  background: #6a6c6e7e;
  border-radius: 10px;
}
</style>
