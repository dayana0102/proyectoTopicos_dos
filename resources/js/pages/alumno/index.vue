<template>
  <div>
    <navigation :items="items" :personales="personales" :cursos="cursos" />
    <div>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import navigation from "../../components/navigation.vue";

export default {
  middleware: ["auth", "role:4"],
  metaInfo() {
    return { title: this.$t("Alumno") };
  },
  data() {
    return {
      items: [{ title: "Mis Paneles", icon: "mdi-table", to: "dash.alumno" }]
    };
  },
  created(){
    this.getpaneles();
  },
  components:{
    navigation
  },
  computed: {
    ...mapState("panel", ["personales", 'cursos']),
  },
  methods:{
    ...mapActions('panel', ['getpaneles']),
  }
};
</script>
