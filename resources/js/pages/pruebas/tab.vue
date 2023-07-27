<template>
    <div style="color: #172b4d;">
    <div class="mx-2 cardList">
      <div class="d-flex lists_header px-2 py-3">
        <div style="width: 87%" class="px-1">
          <input 
            type="text"
            class="titleStyle"
            @keyup.enter="changeNameList()"
            @keyup.escape="$refs.nameList.blur()"
            ref="nameList"
            
            />
        </div>
        <div
          class="listMenu d-flex align-center justify-center"
          style="width: 13%; text-align: center;"
        >
          <div><v-icon class="">mdi-dots-horizontal</v-icon></div>
        </div>
      </div>
      <div>
    <div class="lists_body pa-2">
      <v-card>
        {{ nametablero }}
        <componente-b style="float: right; height: 10px;"></componente-b>

      </v-card>
    </div>
  </div>

      <div class="lists_footer pa-3">
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
          <div class="pb-3" style="height: 28px;">
            <input
              v-model="forms.nameWork"
              type="text"
              class="titleStyle addlist"
              ref="newWork"
              @keyup.escape="activeNewWork = false"
              @keyup.enter="addNewWork()"
            />
          </div>
          <div class="d-flex align-center pt-2">
            <v-btn
              color="primary"
              elevation="0"
              x-small
              class="mr-1"
              @click="addNewList()"
            >
              Añadir Lista
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
import ComponenteB from "./ComponenteB.vue";
import form from "vform";

export default {
  components: { ComponenteB },
  name: "workList",
  props: {
    data: { default: "" }
  },
  data() {
    return {
      nametablero: "Hola",
      activeNewWork: false,
      works: [],
      forms: new form({
        nameWork: ""
      })
    };
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
    editContent() {
      // Aquí implementa la lógica para editar el contenido
      // Puedes mostrar un diálogo de edición, cargar un formulario, etc.
    },
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
