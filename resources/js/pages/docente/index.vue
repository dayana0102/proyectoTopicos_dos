<template>
  <div  v-if="user">
    <navigation :items="items" :personales="personales" :cursos="cursos" />
    <div>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState, mapActions } from 'vuex';
import navigation from "../../components/navigation.vue";

export default {
  middleware: ["auth", "role:3"],

  metaInfo() {
    return { title: this.$t("Docente") };
  },
  data(){
    return{
      items: [
        { title: "Mis Paneles", icon: "mdi-table", to:"dash.docente" },
      ]
    }
  },
  created(){
    this.getpaneles();
  },
  components:{
    navigation
  },
  computed:{
    ...mapState("panel", ["personales", 'cursos']),
    ...mapGetters({
      user:"auth/user"
    })
  },
  methods:{
    ...mapActions('panel', ['getpaneles']),
  }
  

};
</script>
