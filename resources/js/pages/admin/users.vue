<template>
  <div class="pa-3">
    <v-card class="mb-3 d-flex align-center">
      <v-card-title>
        Usuarios
      </v-card-title>
      <addUser/>
    </v-card>
    <v-card>
      <v-data-table
        :headers="headers"
        :items="usersDup"
        :loading="loading"
        loading-text="Cargando datos">
        <template #[`item.actions`]="{ item }">
          <editUser :user="item"/>
        </template>
        <template #[`item.rol_id`]="{ item }">
          {{ item.rol_id == 1 ? 'Administrador' 
             : item.rol_id == 2 ? 'Escuela'
             : item.rol_id == 3 ? 'Docente' : 'Alumno'}}
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import addUser from "~/components/admin/newUser.vue";
import editUser from "~/components/admin/editUser.vue";

export default {
  name: "controlUser",
  created() {
    this.getUsers()
  },
  components:{
    addUser, editUser
  },
  data() {
    return {
      headers: [
        { text: "Nombre", value: "name" },
        { text: "DNI", value: "dni" },
        { text: "Email", value: "email" },
        { text: "Rol", value: "rol_id" },
        { text: "Acciones", value: "actions" }
      ],
    };
  },
  computed:{
    ...mapState("admin_users", ["usersDup", "loading"]),
  },
  methods:{
    ...mapActions("admin_users", ["getUsers"]),
  }
};
</script>
