<template>
  <v-card style="background-color: #893143;">
    <v-icon>mdi-key</v-icon>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
        buscar: "",
      encabezado: [
        {
          text: "Nombres",
          value: "name"
        },
        {
          text: "Edad",
          value: "edad_alumno"
        },
        {
          text: "Semestre",
          value: "sem"
        }
      ],
      alumnos: [
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "AAAAAA",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        },
        {
          name: "Eduardo",
          edad_alumno: 23,
          sem: "X"
        }
      ]
    };
  }
};
</script>
