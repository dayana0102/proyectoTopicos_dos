<template>
  <v-dialog v-model="dialog" persistent width="500">
    <template #activator="{attrs, on}">
      <v-btn
        v-bind="attrs"
        v-on="on"
        color="teal"
        dark
        small
        @click="asignValue()"
      >
        Editar
      </v-btn>
    </template>
    <v-card>
      <v-card-title>Editar Usuario</v-card-title>
      <div class="px-3">
        <v-text-field v-model="form.name"></v-text-field>
        <v-text-field v-model="form.dni"></v-text-field>
        <v-text-field v-model="form.email"></v-text-field>
        <v-text-field
          v-if="user.rol_id == 4"
          v-model="form.codigo"
        ></v-text-field>
      </div>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" dark small>
          Guardar
        </v-btn>
        <v-btn color="error" dark small @click="close()">
          Cancelar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import Form from "vform";

export default {
  name: "editUser",
  data() {
    return {
      dialog: false,
      form: new Form({
        name: "",
        dni: "",
        email: "",
        codigo: ""
      })
    };
  },
  props: {
    user: { default: {} }
  },
  methods: {
    guardar() {
      this.dialog = false;
      this.form.reset();
    },
    close() {
      this.dialog = false;
      this.form.reset();
    },
    asignValue() {
      this.form.keys().forEach(key => {
        this.form[key] = this.user[key];
      });
    }
  }
};
</script>
