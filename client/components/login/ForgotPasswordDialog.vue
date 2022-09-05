<template>
  <v-dialog
    v-model="dialog"
    overlay-color="black"
    overlay-opacity="0.7"
    max-width="600px"
  >
    <template #activator="{ on, attrs }">
      <v-btn v-bind="attrs" plain v-on="on"> Forgot your password? </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">Type in your email</span>
      </v-card-title>
      <validation-observer v-slot="{ invalid }" ref="form">
        <form @submit.prevent="attemptResetPassword">
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <validation-provider
                    v-slot="{ errors }"
                    mode="eager"
                    name="Email"
                    rules="email|required"
                  >
                    <v-text-field
                      v-model="email"
                      :error-messages="errors"
                      label="Email*"
                      required
                      @keydown="listenToEnter"
                    />
                  </validation-provider>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" :disabled="invalid" type="submit">
              Submit
            </v-btn>
          </v-card-actions>
        </form>
      </validation-observer>
    </v-card>
  </v-dialog>
</template>

<script>
import { ValidationProvider } from 'vee-validate'
import validation from '~/mixins/validation'

export default {
  name: 'ForgotPasswordDialog',
  components: { ValidationProvider },
  mixins: [validation],
  data() {
    return {
      email: '',
      dialog: false,
    }
  },
  methods: {
    async attemptResetPassword() {
      try {
        await this.$api('sanctum/csrf-cookie').index()
        await this.$api('auth/forgot-password').create({
          email: this.email,
        })
        this.$notifier.showMessage({ content: 'Email sent successfuly' })
        this.dialog = false
      } catch (error) {
        this.$kdal.error(error)
      }
    },

    listenToEnter(key) {
      if (key === 'Enter') this.attemptResetPassword()
    },
  },
}
</script>
