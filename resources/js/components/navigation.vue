<template>
  <div>
    <v-app-bar
      color="trasparend"
      elevation="0"
      fixed
      width="45"
      style="margin-left:5px ; background-color:transparent;">
      <v-app-bar-nav-icon
        color="white"
        style="font-size:50px"
        @click.stop="drawer = !drawer"
      ></v-app-bar-nav-icon>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      left
      temporary
      absolute
      color="#1d3461"
      dark>
      <v-list dense>
        <router-link
          v-for="(item, i) in items"
          :key="i"
          :to="{ name: item.to }"
          link
          style="text-decoration:none">
          <v-list-item link class="iconos" style="color:white;">
            <v-list-item-icon>
              <v-icon color="white">{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item>
        </router-link>
        <v-divider class="py-1"></v-divider>
        <v-list-group prepend-icon="mdi-book-multiple" v-if="cursos.length > 0">
          <template #activator>
            <v-list-item-title>
              Cursos
            </v-list-item-title>
          </template>
          <router-link
            v-for="(curso, i) in cursos"
            :key="i"
            :to="{ name: 'board', params: { id: curso.id } }">
            <v-list-item link >
              <v-list-item-avatar rounded>
                <v-avatar rounded size="27">
                  <!-- <img
                    src="https://format.creatorcdn.com/39046a8a-f7a8-4079-934d-73246154c174/0/0/0/0,0,3643,2429,1200,2429/0-0-0/e9b75b5b-f0cc-4f40-ac0b-7289a8e34cc0/1/1/Glacier_-_IMG_0360_copy.jpg?fjkss=exp=2001627945~hmac=210b763337c9a31e7142cca5c069e808fac3dae89e5ebb38d0f8c45698bef539&1200"
                    alt="turu"/> -->
                </v-avatar>
              </v-list-item-avatar>
              <v-list-item-title>{{ curso.nombre }}</v-list-item-title>
            </v-list-item>
          </router-link>
        </v-list-group>
        <v-list-group prepend-icon="mdi-account-box" v-if="personales.length > 0">
          <template #activator>
            <v-list-item-title>
              Personales
            </v-list-item-title>
          </template>
          <router-link
            v-for="(personal, i) in personales"
            :key="i"
            :to="{ name: 'board', params: { id: personal.id } }">
            <v-list-item link >
              <v-list-item-avatar rounded>
                <v-avatar rounded size="27">
                  <!-- <img
                    src="https://format.creatorcdn.com/39046a8a-f7a8-4079-934d-73246154c174/0/0/0/0,0,3643,2429,1200,2429/0-0-0/e9b75b5b-f0cc-4f40-ac0b-7289a8e34cc0/1/1/Glacier_-_IMG_0360_copy.jpg?fjkss=exp=2001627945~hmac=210b763337c9a31e7142cca5c069e808fac3dae89e5ebb38d0f8c45698bef539&1200"
                    alt="turu"/> -->
                </v-avatar>
              </v-list-item-avatar>
              <v-list-item-title>{{ personal.nombre }}</v-list-item-title>
            </v-list-item>
          </router-link>
        </v-list-group>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "navigation",
  props: {
    items: { default: "" },
    personales: { default: "" },
    cursos: { default: "" }
  },
  computed: {
    ...mapGetters({
      user: "auth/user"
    })
  },
  data() {
    return {
      drawer: false,
      mini: true
    };
  }
};
</script>
<style></style>
