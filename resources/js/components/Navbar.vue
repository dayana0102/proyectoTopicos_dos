<template>
  <v-app-bar app :color="bgNavbar" elevation="0">
    <v-toolbar
      dense
      elevation="0"
      style="background-color: transparent;  color:#fff;">
      <v-toolbar-title class="ml-7">{{ appName }}</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn plain :to="{ name: linksVerified.path }" color="#fff">
        {{ linksVerified.name }}
      </v-btn>
      <v-menu v-if="user" bottom min-width="220px" rounded offset-y>
        <template v-slot:activator="{ on }">
          <v-btn
            icon
            elevation="0"
            :color="letra_color"
            dense
            x-large
            v-on="on"
          >
            <v-avatar size="42">
              <v-icon :color="letra_color">mdi-account</v-icon>
            </v-avatar>
          </v-btn>
        </template>
        <v-card>
          <v-list-item-content>
            <div style="flex-direction:column;">
              <div class="text-center">
                <h4 class="text-wrap">{{ user.nombre }}</h4>
                <p class="text-caption mt-1">
                  {{ user.email }}
                </p>
              </div>
              <v-divider class="my-1"></v-divider>
              <div style="    display: table-caption;">
                <v-btn depressed rounded text to="/settings">
                  <v-icon left>mdi-account-box-outline</v-icon>
                  Perfil
                </v-btn>
                <v-btn depressed rounded text @click="logout">
                  <v-icon left>mdi-logout</v-icon>
                  Salir
                </v-btn>
              </div>
            </div>
          </v-list-item-content>
        </v-card>
      </v-menu>
    </v-toolbar>
  </v-app-bar>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data: () => ({
    appName: window.config.appName,
    bgNavbar: "#1d3461",
    colorletra: "#fff",
    rounded: false,
    letra_color: "#fff"
  }),
  computed: {
    ...mapGetters({
      user: "auth/user",
      firstRoute: "auth/firstRoute"
    }),
    linksVerified: function() {
      return { name: "Inicio", path: this.firstRoute };
    }
  },
  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");
      // Redirect to login.
      this.$router.push({ name: "login" });
    },
    changeColor() {
      if (document.body.scrollTop > 10 ||document.documentElement.scrollTop > 10) {
        this.bgNavbar = "white";
      } else {
        this.bgNavbar = "transparent";
      }
    }
  }
};
</script>

<style scoped>
.cristal {
  backdrop-filter: blur(10px) !important;
}
</style>
