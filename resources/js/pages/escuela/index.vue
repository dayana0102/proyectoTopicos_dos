<template>
  <div>
    <navigation :items="items" :personales="personales" :cursos="cursos" />
    <div>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import navigation from "../../components/navigation.vue";

export default {
  middleware: ["auth", "role:2"],
  metaInfo() {
    // return { title: this.$t("Escuela") };
  },
  components: {
    navigation
  },
  created(){
    this.getpaneles();
  },
  data(){
    return{
      items: [
        { title: "Activos", icon: "mdi-book-edit", to:"dash.escuela" },
        { title: "Cursos", icon: "mdi-book", to:"cursos.escuela" },
        { title: "Docentes", icon: "mdi-human-male-board", to:"docentes.escuela" },
        { title: "Mis Paneles", icon: "mdi-table", to:"panel.escuela" },
      ]
    }
  },
  computed:{
    ...mapState("panel", ["personales", 'cursos']),
  },
  methods:{
    ...mapActions('panel', ['getpaneles']),
  }
};
</script>
