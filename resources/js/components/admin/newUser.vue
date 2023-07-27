<template>
  <v-dialog v-model="dialog" persistent width="600">
    <template #activator="{attrs, on}">
      <v-btn v-bind="attrs" v-on="on" color="primary" class="ml-auto mr-3"
        >Agregar</v-btn
      >
    </template>
    <v-card>
      <v-card-title>Agregar Usuario</v-card-title>
      <div class="px-2">
        <v-text-field
          v-model="formAdd.nombre"
          label="Ingrese el nombre"
        ></v-text-field>
        <v-text-field
          v-model="formAdd.email"
          label="Ingrese email"
        ></v-text-field>
        <v-select
          v-model="formAdd.rol"
          :items="rolOption"
          item-text="rol"
          item-value="id"
          label="Seleccione rol"
        ></v-select>
        <v-text-field v-model="formAdd.dni" label="Ingrese DNI"></v-text-field>
      </div>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="addUserComp()" small>Aceptar</v-btn>
        <v-btn color="error" @click="closeAddComp()" small>Cancelar</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import Form from "vform";
import { mapActions, mapState } from "vuex";
export default {
  name: "addUser",
  data() {
    return {
      rolOption: [
        { id: 2, rol: "Escuela" },
        { id: 3, rol: "Docente" },
        { id: 4, rol: "Alumno" }
      ],
      dialog: false,
      formAdd: new Form({
        nombre: "",
        email: "",
        rol: "",
        dni: ""
      })
    };
  },
  computed: {

    // ...mapState("admin_users", [""])
  },
  methods: {
    ...mapActions("admin_users", ["addUser", "closeAdd"]),
    addUserComp() {
      this.dialog = false;
      this.addUser(this.formAdd);
    },
    closeAddComp() {
      this.dialog = false;
      this.closeAdd();
    }
  }
};
</script>
