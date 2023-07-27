<template>
  <div style="color: #172b4d;">
    <div class="mx-2 cardList">
      <div class="d-flex lists_header px-2 py-3">
        <div style="width: 87%" class="px-1">
          <input 
            type="text"
            class="titleStyle"
            onfocus="this.select()"
            v-model="data.nombre"
            readonly
            @keyup.enter="changeNameList()"
            @keyup.escape="$refs.nameList.blur()"
            ref="nameList"
            />
        </div>
        <div
          class="listMenu d-flex align-center justify-center"
          style="width: 13%; text-align: center;"
        >
          <div><options></options> </div>
        </div>
      </div>
      
      <div class="lists_body py-2 px-3">
        <v-card height="auto pa-3 "  v-for="(sublista,i) in data.subtareas" :key="i">
          <div class="mt-2">
            <seccion :data="sublista" :infopanel="infopanel" />
          </div>
        </v-card>
      </div>
      
      <div class="lists_footer pa-3" v-if="this.infopanel.addgrupo">
        <div
          @click="showCreateWork()"
          v-if="!activeNewWork"
          class="d-flex align-center"
          style="cursor: pointer;"
        >
          <div><v-icon>mdi-plus</v-icon></div>
          <div class="pa-1" style="color: #172b4d;">Añada otra lista</div>
        </div>
        <div v-else>
          <div>
            <v-select
            :items="tipos"
            v-model="forms.tipo"
            item-text="tipo"
            item-value="id"
            label="tipo de Sección"
            dense
            ></v-select>
          </div>
          <div v-if="forms.tipo==2">
            <v-text-field
            type="datetime-local"
            label="Fecha limite"
            dense
            v-model="forms.fechalimite"
            ></v-text-field>
          </div>
          <div class="pb-3" style="height: 28px;">
            
            <v-text-field
              v-model="forms.nombresubgrupo"
              type="text"
              class="titleStyle addlist"
              ref="newWork"
              dense
              label="Nombre"
              @keyup.escape="activeNewWork = false"
              @keyup.enter="addNewWork()"
            ></v-text-field>
          </div>
          <div class="d-flex align-center pt-2">
            <v-btn
              color="primary"
              elevation="0"
              x-small
              class="mr-1"
              @click="addNewList()"
            >
              Añadir sección
            </v-btn>
            
            <div>
              <v-icon @click="activeNewWork = false">mdi-close</v-icon>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import form from "vform";
import seccion from './editList.vue';
import options from "./options.vue";
import {mapGetters,mapActions} from 'vuex'
export default {
  components: { seccion , options},
  name: "workList",
  props: {
    data: { default: "" }
  },
  data() {
    return {
      
      activeNewWork: false,
      works: [],
      forms: new form({
        panel_id:'',
        grupo_id:this.data.id,
        nombresubgrupo:'',
        tipo:'',
        fechalimite:'',
      }),
      tipos:[
        {tipo:'Informativo',id:1},
        {tipo:'Tarea',id:2},  //tarea
      ]
    };
  },
  computed:{
    ...mapGetters({
      infopanel:'panel/infopanel',
    })
  },
  methods: {
    changeNameList(){
      this.$refs.nameList.blur();

    },
    showCreateWork() {
      this.activeNewWork = true;
      this.$nextTick(() => {
        this.$refs.newWork.focus();
      });
    },
    addNewWork() {
      this.works.push(1);
      this.forms.nameWork = "";
    },
    ...mapActions('panel',['getinfopanel']),
    addNewList(){
      this.forms.panel_id=this.infopanel.id;
      this.forms.post('/api/add-subtarea-grupo').then(response=>{
        this.forms.reset();
        this.getinfopanel({id:this.infopanel.id});
      }).catch(error=>{

      })
    }
  }
};
</script>
<style>
.cardList {
  width: 265px;
  background-color: #f1f2f4;
  flex-grow: 0;
  border-radius: 10px;
  box-shadow: 0px 1px 1px #091e4240, 0px 0px 1px #091e424f;
}

.lists_header {
  height: 48px;
  align-items: center;
}

.lists_header div input {
  width: 100%;
  height: 28px;
  padding: 0 8px;
  font-size: 14px;
  font-weight: 600;
  color: #172b4d;
}

.lists_footer {
  min-height: 46px;
}

.listMenu {
  height: 32px;
  widows: 32px;
  border-radius: 3px;
  cursor: pointer;
}
</style>
