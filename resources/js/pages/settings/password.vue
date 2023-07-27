<template>
   <v-container fluid fill-height>
    <v-layout align-center justify-center >
      <v-card :title="$t('your_password')" >
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
          <alert-success :form="form" :message="$t('password_updated')" />
          <!-- Password -->
          <div style="margin: 30px;">
            <div class="row justify-content-center" style="margin-top: 20px; padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-center" style="margin-right: 30px; width: 200px; padding-top:15px ;">
                <label class="col-md-5 col-form-label text-md-end">{{
                  $t("new_password")
                }}</label>
              </div>
              <div class="justify-content-center" style="width: 300px;">
                <v-text-field
                  v-model="form.password"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                  :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                  class="form-control"
                  type="password"
                  name="password"
                  counter
                ></v-text-field>
                <has-error :form="form" field="password" />
              </div>
            </div>


            <!-- Password Confirmation -->
            <div class="row justify-content-center" style="margin-top: 20px; padding-left: 55px; padding-right: 55px;">
              <div class="justify-content-center" style="margin-right: 30px; width: 200px; padding-top:15px ;">
                <label class="col-md-3 col-form-label text-md-end">{{
                  $t("confirm_password")
                }}</label>
              </div>
              <div class="justify-content-center" style="width: 300px;">
                <v-text-field
                  v-model="form.password_confirmation"
                  :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                  :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                  class="form-control"
                  type="password"
                  name="password_confirmation"
                  counter
                ></v-text-field>
                <has-error :form="form" field="password_confirmation" />
              </div>
            </div>

            <!-- Submit Button -->

            <v-layout align-center justify-center>
              <v-btn class="mt-12 justify-content-center" outlined color="green darken-1" :loading="form.busy" type="success">
                {{ $t("update") }}
                <v-icon class="ml-1">mdi-update</v-icon>
              </v-btn>
            </v-layout>

          </div>
        </form>
      </v-card>
    </v-layout>
  </v-container>
</template>

<script>
import Form from "vform";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      password: "",
      password_confirmation: "",
    }),
  }),

  methods: {
    async update() {
      await this.form.patch("/api/settings/password");

      this.form.reset();
    },
  },
};
</script>
