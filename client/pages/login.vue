<template>
  <v-layout fill-height justify-center align-center>
    <v-col cols="6" align-self="center">
      <v-card>
        <validation-observer v-slot="{ invalid }" ref="form">
          <form @submit.prevent="attemptLogin">
            <v-card-title class="text-h5">
              <v-img
                class="mr-2"
                contain
                height="35"
                max-width="35"
                src="png/CAD-coin.png"
              />
              <span> Moneyfy </span>
            </v-card-title>
            <v-card-text class="card-content p-6">
              <validation-provider
                v-slot="{ errors }"
                mode="eager"
                name="Email"
                rules="email|required"
              >
                <v-text-field
                  v-model="guest.email"
                  :error-messages="errors"
                  label="Email"
                  required
                />
              </validation-provider>
              <validation-provider
                v-slot="{ errors }"
                mode="eager"
                name="Password"
                rules="required|min:8"
              >
                <v-text-field
                  v-model="guest.password"
                  :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  counter
                  :error-messages="errors"
                  hint="At least 8 characters"
                  label="Password"
                  name="password"
                  :type="showPassword ? 'text' : 'password'"
                  @click:append="showPassword = !showPassword"
                />
              </validation-provider>
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary-dark" :disabled="invalid" type="submit">
                Submit
              </v-btn>
              <ForgotPasswordDialog />
              <RegisterDialog />
            </v-card-actions>
          </form>
        </validation-observer>
      </v-card>
    </v-col>
  </v-layout>
</template>

<script>
import { ValidationProvider } from 'vee-validate'
import RegisterDialog from '~/components/login/RegisterDialog.vue'
import validation from '~/mixins/validation'
import ForgotPasswordDialog from '~/components/login/ForgotPasswordDialog.vue'

export default {
  name: 'LoginPage',
  auth: false,
  components: { RegisterDialog, ValidationProvider, ForgotPasswordDialog },
  mixins: [validation],
  layout: 'guest',
  data: () => ({
    guest: {
      email: '',
      password: '',
    },
    showPassword: false,
  }),
  methods: {
    /**
     * Validate and authorize provided credentials
     */
    async attemptLogin() {
      if (!(await this.$refs.form.validate())) return
      try {
        await this.$auth.loginWith('sanctum', {
          data: this.guest,
        })
        await this.$router.push('/')
      } catch (error) {
        this.$kdal.error(error)
      }
    },

    resetPassord() {},
  },
}
</script>
