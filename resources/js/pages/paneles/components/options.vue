<template>
  <div>
  

    <!-- Dialog para cada opción -->
    <v-dialog v-model="showDialog">
      <!-- Opcion A -->
      <div v-if="selectOptions === 'A'">
        <v-card>
          <v-card-title>{{ selectOptions }}</v-card-title>
          <v-card-text>
            <!-- Contenido del diálogo para cada opción -->
            Contenido del diálogo para {{ selectOptions }}
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="closeDialog">Cerrar</v-btn>
          </v-card-actions>
        </v-card>
      </div>

      <!-- Opcion A -->
      <div v-if="selectOptions === 'B'">
        <v-card>
          <v-card-title>{{ selectOptions }}</v-card-title>
          <v-card-text>
            <!-- Contenido del diálogo para cada opción -->
            Contenido del diálogo para {{ selectOptions }}
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="closeDialog">Cerrar</v-btn>
          </v-card-actions>
        </v-card>
      </div>

      <!-- Opcion A -->
      <div v-if="selectOptions === 'C'">
        <v-card>
          <v-card-title>{{ selectOptions }}</v-card-title>
          <v-card-text>
            <!-- Contenido del diálogo para cada opción -->
            Contenido del diálogo para {{ selectOptions }}
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="closeDialog">Cerrar</v-btn>
          </v-card-actions>
        </v-card>
      </div>


    </v-dialog>


  </div>
</template>

<script>
export default {
  data() {
    return {
      showVList: false,
      showDialog: false,
      selectOptions: '',
    };
  },
  methods: {
    openDialog(dialogName) {
      this.selectOptions = dialogName;
      this.showDialog = true;
      this.showVList = false; // Ocultar el menú cuando se abre un diálogo
    },
    closeDialog() {
      this.selectOptions = '';
      this.showDialog = false;
    },
  },
};
</script>

<style>
/* Ajustar al contenido */
.my-v-menu__content {
  min-width: auto !important;
  max-width: 200px;
}
</style>

  