<template>
  <v-dialog v-model="dialog" width="600">
    <template #activator="{attrs, on}">
      <v-alert
        v-bind="attrs"
        v-on="on"
        elevation="3"
        height="170"
        border="left"
        colored-border
        color="green accent-4">
        <v-card-title class="px-1 pt-1">
            {{ panel.nombre }}
        </v-card-title>
        <v-card-text> {{ panel.docentes[0].name }}</v-card-text>
      </v-alert>
    </template>
    <v-card>
        <v-card-title>{{ panel.nombre }}</v-card-title>
    </v-card>
  </v-dialog>
</template>
<script>

export default {
  name: "cursosActivos",
  props:{
    panel: {default:[]},
  },
  data() {
    return {
      dialog: false
    };
  },
};
</script>
