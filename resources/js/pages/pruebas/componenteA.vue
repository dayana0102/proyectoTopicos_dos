<template>
  <div>
    <v-btn @click="abrirDialogEditar">Abrir Diálogo</v-btn>
     <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-container fluid class="fondo-card-edit">
          <div class="justify-content-center mx-6 mb-6">
            <v-card-title class="mb-5">FECHAS</v-card-title>
            <div class="row justify-content-center">
              <!-- Fechas -->
              <div class="justify-content-left ml-7">
                <!-- Fechas -->
                <v-menu
                  v-model="menufecha"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="date"
                      label="Fecha de vencimiento"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" @input="menufecha = false"></v-date-picker>
                </v-menu>
                <!-- Horas -->
                <v-menu
                  ref="menu"
                  v-model="menuTime"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  :return-value.sync="time"
                  transition="scale-transition"
                  offset-y
                  max-width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="time"
                      label="Hora"
                      prepend-icon="mdi-clock-time-four-outline"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-time-picker
                    v-if="menuTime"
                    v-model="time"
                    full-width
                    @click:minute="$refs.menu.save(time)"
                  ></v-time-picker>
                </v-menu>
                <!--  recordatorio -->
                <v-select v-model="reminder" :items="reminderOptions" label="Recordatorio"></v-select>
                <!-- Botones -->
                <v-layout align-center justify-center>
                  <v-btn class="mt-12 justify-content-center mr-5" text color="#039BE5" @click="cancelarFecha">
                    Cancelar
                  </v-btn>
                  <v-btn class="mt-12 justify-content-center ml-5" text color="indigo lighten-2" @click="saveFecha">
                    Guardar
                  </v-btn>
                </v-layout>
              </div>
            </div>
          </div>
        </v-container>
      </v-card>
    </v-dialog>

    <!-- El div para mostrar los datos guardados -->
    <div v-if="datosGuardados" @click="abrirDialogEditar">
      <p>Fecha de vencimiento guardada: {{ date }}</p>
      <p>Hora guardada: {{ time }}</p>
      <p>Recordatorio guardado: {{ reminder }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      menufecha: false,
      menuTime: false,
      date: '',
      time: '',
      reminder: null,
      reminderOptions: ['Recordatorio 1', 'Recordatorio 2', 'Recordatorio 3'],
      datosGuardados: false, // Variable para controlar si se han guardado los datos
    };
  },
  methods: {
    saveFecha() {
      // Aquí puedes realizar alguna validación de los datos antes de guardarlos
      this.datosGuardados = true;
      this.dialog = false; // Cerramos el diálogo después de guardar los datos
    },
    cancelarFecha() {
      this.dialog = false; // Cerrar el diálogo sin guardar los cambios
    },
    abrirDialogEditar() {
      // Método para abrir el diálogo y editar los datos guardados
      this.dialog = true;
    },
  },
};
</script>
