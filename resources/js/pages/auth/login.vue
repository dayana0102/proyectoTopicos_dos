<template>
  <v-container fluid class="fill-height main">
    <v-flex>
      <v-card
        class="mx-auto my-auto h-100 y-6"
        rounded="lg"
        elevation="2"
        width="980"
      >
      <div class="row justify-content-center"> 
        <div class="justify-content-center " >
          <div style="display:grid; place-items: center; ">
            <v-img style="display: flex; margin: auto; margin:30px;" max-width="530" src="/img/img_login.svg" />
           </div>
        </div>

          <div class="justify-content-center " style="display: grid; place-items: center ; margin-right: 30px; width: 350px;">
            <v-card-title class="d-block text-center" style="color: #7986CB; font-size: 22px;"
              >Iniciar sesión</v-card-title
            >
          <v-card-text>
            <v-form
              ref="form"
              @submit.prevent="login"
              @keydown="form.onKeydown($event)"
            >
              <v-text-field
                dense
                v-model="form.email"
                label="Usuario"
                type="text"
                outlined
                prepend-inner-icon="mdi-account-outline"
                required
                autofocus
                :error="form.errors.has('email')"
                color="#7986CB"
                width="300"
              ></v-text-field>

              <v-text-field
                dense
                v-model="form.password"
                label="Contraseña"
                outlined
                prepend-inner-icon="mdi-lock-outline"
                required
                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show1 ? 'text' : 'password'"
                :error="form.errors.has('password')"
                @click:append="show1 = !show1"
                color="#7986CB"
                width="300"
              ></v-text-field>

              <v-flex class="d-flex align-left ">
                <v-checkbox v-model="remember" label="Recordarme" class="mb-0 mt-0" color="#7986CB"></v-checkbox>
              </v-flex>

              <v-btn
                :loading="form.busy"
                color="indigo lighten-2"
                class="mr-4"
                type="submit"
                dark
                block
                width="300"
              >
                Ingresar
              </v-btn>
            </v-form>
            <register />
          </v-card-text>
        </div>
          </div>
      </v-card>
    </v-flex>
  </v-container>
</template>

<script>
import Form from "vform";
import Cookies from "js-cookie";
import LoginWithGithub from "~/components/LoginWithGithub";
import register from "./register.vue";

export default {
  components: {
    LoginWithGithub,
    register
  },

  layout: "init",

  middleware: "guest",

  metaInfo() {
    return { title: this.$t("login") };
  },

  data: () => ({
    appName: window.config.appName,
    form: new Form({
      email: "",
      password: ""
    }),
    remember: false,
    show1: false
  }),

  methods: {
    validate() {
      this.$refs.form.validate();
    },
    async login() {
      this.validate();
      // Submit the form.
      const { data } = await this.form.post("/api/login");

      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember
      });

      // Fetch the user.
      await this.$store.dispatch("auth/fetchUser");

      // Redirect home.
      this.redirect();
    },

    redirect() {
      const intendedUrl = Cookies.get("intended_url");

      if (intendedUrl) {
        Cookies.remove("intended_url");
        this.$router.push({ path: intendedUrl });
      } else {
        const firstRoute = this.$store.getters["auth/firstRoute"];

        this.$router.push({ name: firstRoute });

        // this.$router.push({ name: "home" });
        //this.$router.push(firstRoute);
      }
    }
  }
};
</script>
<style scoped>
.main {
  background-image: linear-gradient(rgba(11, 28, 61, 0.9), rgba(0, 0, 0, 0.4)),
    url("../../../../public/img/fondo-home.jpg");
  background-position: center;
  background-size: cover;
}

.img {
  height: 7.5rem;
  width: 7.5rem;
  padding: 0.5rem;
}
</style>
