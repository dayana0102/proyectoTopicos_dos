<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-card :title="$t('your_info')">
        <form @submit.prevent="update" @keydown="form.onKeydown($event)" class="pa-12">
          <!-- <alert-success :form="form" :message="$t('info_updated')" /> -->
          <div>
            <div class="d-flex justify-content-center" style="align-items: center; justify-content: center;">
              <div class="d-flex justify-content-center">
                <v-avatar style="margin: 10px 10px 10px 30px;" size="130">
                  <v-img src=https://static.vecteezy.com/system/resources/previews/019/896/008/original/male-user-avatar-icon-in-flat-design-style-person-signs-illustration-png.png></v-img>
                </v-avatar>
              </div>
              <div>
                <v-card-title> {{ form.name }}</v-card-title>
                <v-card-subtitle>{{ form.name }} de la escuela de Ingenieria de Sistemas y Computacion</v-card-subtitle>
              </div>
            </div>
          </div>

          <!-- MOSTRAR INFO -->
          <v-card v-if="!edit" elevation="0">
            <div class="row justify-content-center" style="margin-top: 20px; padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-center" style="margin-right: 30px; width: 300px;">
                <div>
                  <v-card-text><strong>Nombres:<br></strong>{{ form.name }}</v-card-text>
                </div>
              </div>
              <div class="justify-content-center" style="width: 300px;">
                <div>
                  <v-card-text><strong>Apellidos:<br></strong>{{ form.name }}</v-card-text>
                </div>
              </div>
            </div>

            <div class="row justify-content-center" style="padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-left" style="margin-right: 30px; width: 300px;">
                <div>
                  <v-card-text><strong>Codigo de matricula (DNI):<br></strong>{{ form.dni }}</v-card-text>
                </div>
              </div>
              <div class="justify-content-left" style="width: 300px;">
                <div>
                  <v-card-text><strong>Correo Electronico:<br></strong>{{ form.email }}</v-card-text>
                </div>
              </div>
            </div>

            <div class="row justify-content-center" style="padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-left" style="margin-right: 30px; width: 300px;">
                <div>
                  <v-card-text><strong>Facultad:<br></strong>{{ form.name }}</v-card-text>
                </div>
              </div>
              <div class="justify-content-left" style="width: 300px;">
                <div>
                  <v-card-text><strong>Escuela:<br></strong>{{ form.name }}</v-card-text>
                </div>
              </div>
            </div>

            <v-layout align-center justify-center>
              <v-btn class="mt-12 justify-content-center" outlined color="indigo" @click.stop="edit = true">
                EDITAR PERFIL
                <v-icon class="ml-1">mdi-pencil</v-icon>
              </v-btn>
            </v-layout>
          </v-card>

          <!-- EDITAR INFO -->
          <v-card v-if="edit" elevation="0">
            <div class="row justify-content-center" style="margin-top: 20px; padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-center" style="margin-right: 30px; width: 350px;">
                <div>
                    <v-text-field
                      v-model="form.name" 
                      label="Nombres"
                      persistent-hint
                      outlined
                      :class="{ 'is-invalid': form.errors.has('name') }" 
                      class="form-control" 
                      type="text" 
                      name="name" >
                    </v-text-field>

                    <has-error :form="form" field="name" />
                </div>
              </div>
              <div class="justify-content-center" style="width: 350px;">
                <div>
                    <v-text-field
                      v-model="form.name" 
                      label="Apellidos"
                      persistent-hint
                      outlined
                      :class="{ 'is-invalid': form.errors.has('name') }" 
                      class="form-control" 
                      type="text" 
                      name="name" >
                  </v-text-field>
                    <has-error :form="form" field="name" />
                </div>
              </div>
            </div>

            <div class="row justify-content-center" style="padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-left" style="margin-right: 30px; width: 350px;">
                <div>
                    <v-text-field
                      v-model="form.dni" 
                      label="Codigo de matricula"
                      persistent-hint
                      outlined
                      :class="{ 'is-invalid': form.errors.has('dni') }" 
                      class="form-control" 
                      type="text" 
                      name="dni" >
                    </v-text-field>
                    <has-error :form="form" field="dni" />
                </div>
              </div>
              <div class="justify-content-left" style="width: 350px;">
                <div>
                    <v-text-field 
                      v-model="form.email" 
                      label="Correro Electronico"
                      persistent-hint
                      outlined
                      :class="{ 'is-invalid': form.errors.has('email') }" 
                      class="form-control" 
                      type="email" 
                      name="email"> 
                    </v-text-field>
                    <has-error :form="form" field="email" />
                </div>
              </div>
            </div>

            <div class="row justify-content-center" style="padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-left" style="margin-right: 30px; width: 350px;">
                <div>
                  <v-card-text><strong>Facultad:<br></strong>{{ form.name }}</v-card-text>
                </div>
              </div>
              <div class="justify-content-left" style="width: 350px;">
                <div>
                  <v-card-text><strong>Escuela:<br></strong>{{ form.name }}</v-card-text>
                </div>
              </div>
            </div>

            <v-layout align-center justify-center>
              <v-btn class="mt-12 justify-content-center" outlined color="green darken-1" :loading="form.busy" type="success">
                {{ $t("update") }}
                <v-icon class="ml-1">mdi-update</v-icon>
              </v-btn>
              <v-btn class="mt-12 ml-10 justify-content-center" outlined color="pink darken-2" >
                CANCELAR
                <v-icon class="ml-1">mdi-close-box-multiple </v-icon>
              </v-btn>
            </v-layout>
          </v-card>

        </form>
      </v-card>
    </v-layout>
  </v-container>
</template>

<script>
import Form from "vform";
import { mapGetters } from "vuex";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      name: "",
      email: "",
      dni: "",
      rol_id: "",
    }),
    edit: false,
  }),

  computed: mapGetters({
    user: "auth/user",
  }),

  created() {
    // Fill the form with user data.
    this.form.keys().forEach((key) => {
      this.form[key] = this.user[key];
    });
  },

  methods: {
    async update() {
      const { data } = await this.form.patch("/api/settings/profile");
      this.$store.dispatch("auth/updateUser", { user: data });
    },
  },
};
</script>
