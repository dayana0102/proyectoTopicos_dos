<template>
  <div>
    <navigation :items="items" :personales="personales" :cursos="cursos" />
    <div>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import navigation from "../../components/navigation.vue";

export default {
  middleware: ["auth", "role:1"],
  metaInfo() {
    return { title: this.$t("Administrador") };
  },
  components: {
    navigation
  },
  created(){
    this.getpaneles();
  },
  data() {
    return {
      items: [
        // { title: "Control de Paneles", icon: "mdi-account", to: "dash.admin" },
        { title: "Usuarios", icon: "mdi-account-multiple", to: "users.admin" },
        // { title: "Cursos", icon: "mdi-account", to: "cursos.admin" },
        { title: "Mis Paneles", icon: "mdi-table", to: "paneles.admin" }
      ]
    };
  },
  computed: {
    ...mapState("panel", ["personales", 'cursos']),
  },
  methods:{
    ...mapActions('panel', ['getpaneles']),
  }
};
</script>
