<template>
  <v-dialog v-model="dialog"           
      class="mx-auto my-auto h-100 y-6"
      rounded="lg"
      elevation="2"
      width="980"
      
      >
    <template #activator="{attrs, on}">
      <v-btn
        v-bind="attrs"
        v-on="on"
        class="mr-4 mt-4"
        color="#9E9E9E"
        dark
        block
        width="300"
      >Registrate</v-btn>
    </template>
    <v-card class="px-4 py-6" shaped>
    <div class="row justify-content-center"> 
        <div class="justify-content-center " style=" width: 350px; display: grid; place-items: center ; margin-left: 50px; margin-right: 30px; margin-top: 20px; margin-bottom: 20px;">
          <v-card-title class="d-block text-center" style="color: #7986CB; font-size: 22px;"
            > Registrate </v-card-title>
          <div v-if="messageCorreo" class="d-flex justify-center px-3 pb-5" style="width: 100%;">
            <v-alert
              v-if="loading"
              dense
              text
              type="info"
              width="100%">
              Buscando...
              <v-progress-linear
                indeterminate
                color="light-blue"
                height="10"
                striped
              ></v-progress-linear>
            </v-alert>
            <div v-else style="width: 100%;">
              <v-alert
                dense
                text
                :type="tipoMessage"
                width="100%">
                {{ infoMessage }}
            </v-alert>
            </div>
          </div>
        <form
          @submit.prevent="register()"
          @keydown="form.onKeydown($event)">
          <v-text-field
            class="mb-1"
            required
            dense
            v-model="form.codigo"
            label="Código de estudiante"
            @input="obtenerEmail()"
            @blur="desenfoqueFunction()"
            outlined
            color="#7986CB"
            width="300">
          </v-text-field>
          <v-text-field 
            v-model="form.password"
            :type="show ? 'text' : 'password'"
            :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="show = !show"
            :rules="[rules.required, rules.min]"
            required
            dense
            label="Contraseña"
            outlined
            width="300"
            color="#7986CB">
          </v-text-field>
          <v-text-field 
            v-model="form.password_confirmation"
            :type="show1 ? 'text' : 'password'"
            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="show1 = !show1"
            required
            dense
            :rules="[rules.required, rules.min]"
            label="Confirmar Contraseña"
            outlined
            width="300"
            color="#7986CB">
          </v-text-field>
          <div class="d-flex">
            <v-btn 
              type="submit"
              class="mx-auto mt-3"
              color="teal"
              width="300"
              dark
              :loading="buttonLoading"
              rounded>
              Registrar
            </v-btn>
          </div>
        </form>


        <div class="d-flex mt-3" style="width: 100%;">
          <v-btn class="mx-auto" text color="primary" width="100" block small @click="close()">
            Cerrar
          </v-btn>
        </div>
        </div>
        <div class="justify-content-center " >
              <div style="display:grid; place-items: center; ">
                <v-img style="display: flex; margin: auto; margin:30px;" max-width="460" src="/img/img_sing_up.svg" />
              </div>
      </div>
      </div>
    </v-card>
  </v-dialog>
  
</template>

<script>
import Form from "vform";
import LoginWithGithub from "~/components/LoginWithGithub";
import axios from 'axios'
import errorVue from '../../layouts/error.vue';

export default {
  layout: "basic",
  components: {
    LoginWithGithub,
  },
  
  middleware: "guest",

  metaInfo() {
    return { title: this.$t("register") };
  },

  data: () => ({
    form:new Form({
          codigo: "",
          password: "",
          password_confirmation: "", 
      }),
    mustVerifyEmail: false,
    dialog: false,
    show: false,
    show1: false,
    messageCorreo: false,
    buttonLoading:false,
    infoMessage:"",
    loading: false,
    tipoMessage:"",
    rules: {
          required: value => !!value || 'Campo Obligatorio.',
          min: v => v.length >= 8 || 'Min 8 caracteres',
    },
  }),

  methods: {
    register() {
      // Register the user.
      this.buttonLoading = true
       this.form.post("/api/register").then(res=>{
        this.buttonLoading = false;
       }).catch(error=>{
        this.buttonLoading = false
        this.infoMessage = error.response.data.message;
        this.tipoMessage = "error"
       });
    },
    obtenerEmail(){
      this.messageCorreo = true;
      this.loading = true;
      if(this.form.codigo.length == 10){
        axios.get('/api/obtneremail/'+this.form.codigo).then(res => {
          this.infoMessage = "Correo de validación: " + res.data;
          this.tipoMessage = "success";
          this.loading = false;
          this
        }).catch(error=>{
          this.loading = false;
          this.infoMessage = error.response.data.message;
          this.tipoMessage = "error";
        })
      }
    },
    desenfoqueFunction(){
      this.loading = false;
      if (this.form.codigo.length < 10 ){
        this.infoMessage = "Código inválido";
        this.tipoMessage = "error";
      }
    },
    close(){
      this.dialog = false;
      this.form.reset();
      this.loading = false;
      this.tipoMessage = "";
      this.infoMessage = "";
      this.messageCorreo = false
    }
  },
};
</script>
