<template>
  <div>
    <v-app-bar
      lights-out
      prominent
      dark
      id="home-app-bar"
      class="py-3"
      app
      style=" background-color: transparent; position: absolute;"
      elevation="0"
      elevate-on-escroll
      height="80">
      <v-toolbar
        dense
        elevation="0"
        style=" background-color: transparent;"
        height="60">
        <v-img
          class="ml-1 hidden-sm-and-down"
          max-height="55"
          max-width="55"
          src="/img/U-Blanco.png"/>
        <div
          class="text-center d-flex align-center px-2"
          style="font-size: 15px; font-weight: 400; height: 100%;">
          Universidad Nacional <br />
          Daniel Alcides Carrion
        </div>
        <v-spacer></v-spacer>
        <v-app-bar-nav-icon
          class="hidden-md-and-up"
          @click="drawer = !drawer"
        ></v-app-bar-nav-icon>
        <div>
          <v-tabs
            class="hidden-sm-and-down"
            color="#42a5f6"
            optional
            background-color="transparent"
            dark>
            <v-tab
              v-for="(link, i) in linksVerified"
              :key="i"
              :to="link.path"
              :ripple="false"
              class="font-weight-bold"
              text>
              {{ link.name }}
            </v-tab>
          </v-tabs>
        </div>
      </v-toolbar>
    </v-app-bar>
    <v-navigation-drawer v-model="drawer" absolute top temporary>
      <v-list nav dense>
        <v-list-item-group v-model="group" color="red">
          <v-list-item class="px-2">
            <v-list-item-avatar>
              <v-img src="/img/u.png"></v-img>
            </v-list-item-avatar>
            <v-list-item-title>UNDAC</v-list-item-title>
          </v-list-item>
          <v-divider class="mb-3"></v-divider>
          <v-list-item
            v-for="(link, i) in linksVerified"
            :key="i"
            :to="link.path"
            ><v-list-item-icon>
              <v-icon>{{ link.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ link.name }}</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>
<script>
export default {
  data: () => ({
    appName: window.config.appName,
    drawer: false,
    group: null,
    bgNavbar: "#fff",
    letra_color: "#fff"
  }),
  watch: {
    group() {
      this.drawer = false;
    }
  },
  computed: {
    linksVerified: function() {
      return [
        { name: "Inicio", path: "/home", icon: "mdi-home" },
        { name: "Iniciar Sesión", path: "/login", icon: "mdi-account" }
      ];
    }
  },
};

//background-color: rgba(25, 46, 79,0.84);
</script>

<style>
#home-app-bar .v-tabs-slider {
  max-width: 24px;
  margin: 0 auto;
}

#home-app-bar .theme--dark.v-tabs > .v-tabs-bar .v-tab:not(.v-tab--active),
.theme--dark.v-tabs > .v-tabs-bar .v-tab:not(.v-tab--active) > .v-icon,
.theme--dark.v-tabs > .v-tabs-bar .v-tab:not(.v-tab--active) > .v-btn,
.theme--dark.v-tabs > .v-tabs-bar .v-tab--disabled {
  color: rgb(255 255 255) !important;
}
#home-app-bar .v-item-group {
  color: #00e1fe !important;
}
</style>
