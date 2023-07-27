<template>
  <div class="row drawer-container">
    <div class="col-md-3">
      <v-card elevation="1" width="256" height="100%">
        <v-navigation-drawer v-model="drawer" height="100%">
          <v-card-title>MI PERFIL</v-card-title>
          <v-list dense rounded>
            <v-list-item v-for="item in tabs" :key="item.route" @click="selectTab(item)">
              <v-list-item-icon>
                <v-icon>
                  {{ item.icon }}
                </v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.name }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-navigation-drawer>
      </v-card>
    </div>
    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<style>
.drawer-container {
  height: 100vh;
}

/* Agrega otros estilos personalizados si es necesario */
</style>


<script>
export default {
  middleware: "auth",
  computed: {
    tabs() {
      return [
        {
          icon: "mdi-account",
          name: this.$t("profile"),
          route: "settings.profile",
        },
        {
          icon: "mdi-lock",
          name: this.$t("password"),
          route: "settings.password",
        },
      ];
    },
  },
  methods: {
    selectTab(tab) {
      this.$router.push({ name: tab.route });
    },
  },
};
</script>

<style>
.settings-card .card-body {
  padding: 0;
}

.active {
  background-color: #e0e0e0;
}
</style>
