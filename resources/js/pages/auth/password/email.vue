<template>
    <!-- <v-container fluid class="fill-height main">
      
    </v-container> -->
  <v-container fluid fill-height align-center justify-center>
    <v-card :title="$t('reset_password')" >
      <div style="margin: 30px;">
        <div style="display: grid; place-items: center;">
          <v-img max-width="100" src="/img/u.png" />
        </div>
              
            <v-card-title 
              style="display:grid;place-items: center; margin:10px; color: #3949AB;"> 
              Restablecer contraseña
            </v-card-title>
            <form @submit.prevent="send" @keydown="form.onKeydown($event)">
              <alert-success :form="form" :message="status" />
              <!-- Email -->
              <div >
                  <v-text-field
                    v-model="form.email"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    class="form-control"
                    type="email"
                    name="email"
                    dense
                    outlined
                    prepend-inner-icon="mdi-email"
                    required
                    autofocus
                    color="#3949AB"
                    width="350"
                    
                    ></v-text-field>
                    <has-error :form="form" field="email" />
                </div>
                
                <!-- Submit Button -->
                <div >
                  <v-btn :loading="form.busy"
                    class="mt-0 pa-5"
                    color="#3949AB"
                    dark
                    block
                    width="350">
                    ENVIAR ENLACE DE RESTABLECIMIENTO
                  </v-btn>
              </div>
            </form>
          </div>
      </v-card>
  </v-container>
</template>

<script>
import Form from "vform";

export default {
  layout: "basic",
  middleware: "guest",

  metaInfo() {
    return { title: this.$t("reset_password") };
  },

  data: () => ({
    status: "",
    form: new Form({
      email: "",
    }),
  }),

  methods: {
    async send() {
      const { data } = await this.form.post("/api/password/email");

      this.status = data.status;

      this.form.reset();
    },
  },
};
</script>
<!-- <style scoped>
.main {
  background-image: linear-gradient(rgba(11, 28, 61, 0.9), rgba(0, 0, 0, 0.4)), url("../../../../public/img/fondo-home.jpg") ;
  background-position: center;
  background-size: cover;
}

.img {
  height: 7.5rem;
  width: 7.5rem;
  padding: 0.5rem;
}
</style> -->
