<template>
  <v-dialog
    v-model="dialog"
    overlay-color="black"
    overlay-opacity="0.7"
    max-width="600px"
  >
    <template #activator="{ on, attrs }">
      <v-btn v-bind="attrs" plain v-on="on"> Register </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">User Profile</span>
      </v-card-title>
      <form @submit.prevent="attemptRegistering">
        <validation-observer v-slot="{ invalid }" ref="form">
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12" sm="6" md="4">
                  <validation-provider
                    v-slot="{ errors }"
                    mode="eager"
                    name="First Name"
                    rules="required"
                  >
                    <v-text-field
                      v-model="userDetails.first_name"
                      :error-messages="errors"
                      label="Legal first name*"
                      required
                    ></v-text-field>
                  </validation-provider>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-text-field
                    v-model="userDetails.middle_name"
                    label="Legal middle name"
                  />
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <validation-provider
                    v-slot="{ errors }"
                    mode="eager"
                    name="Last Name"
                    rules="required"
                  >
                    <v-text-field
                      v-model="userDetails.last_name"
                      :error-messages="errors"
                      label="Legal last name*"
                      required
                    />
                  </validation-provider>
                </v-col>
                <v-col cols="12">
                  <validation-provider
                    v-slot="{ errors }"
                    mode="eager"
                    name="Email"
                    rules="email|required"
                  >
                    <v-text-field
                      v-model="userDetails.email"
                      :error-messages="errors"
                      label="Email*"
                      required
                    />
                  </validation-provider>
                </v-col>
                <v-col cols="12">
                  <validation-provider
                    v-slot="{ errors }"
                    mode="eager"
                    name="Password"
                    rules="required|min:8"
                  >
                    <v-text-field
                      v-model="userDetails.password"
                      :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                      :error-messages="errors"
                      hint="At least 8 characters"
                      label="Password*"
                      required
                      :type="showPassword ? 'text' : 'password'"
                      @click:append="showPassword = !showPassword"
                    />
                  </validation-provider>
                </v-col>
                <v-col cols="12" sm="6">
                  <v-switch
                    v-model="userDetails.receives_browser_notifications"
                    label="Receive browser notifications"
                    color="success"
                    default="true"
                  />
                  <v-switch
                    v-model="userDetails.receives_email_notifications"
                    label="Receive email notifications"
                    color="success"
                  />
                </v-col>
              </v-row>
            </v-container>
            <small>*indicates required field</small>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="grey"
              :loading="isSaving"
              text
              @click="dialog = false"
            >
              Close
            </v-btn>
            <v-btn
              color="blue darken-1"
              :disabled="invalid"
              :loading="isSaving"
              text
              type="submit"
            >
              Save
            </v-btn>
          </v-card-actions>
        </validation-observer>
      </form>
    </v-card>
  </v-dialog>
</template>

<script>
import { ValidationProvider } from 'vee-validate'
import validation from '~/mixins/validation'

export default {
  components: { ValidationProvider },
  mixins: [validation],
  data() {
    return {
      dialog: false,
      isSaving: false,
      userDetails: {
        first_name: '',
        middle_name: '',
        last_name: '',
        email: '',
        password: '',
        receives_browser_notifications: true,
        receives_email_notifications: true,
        picture_url: null,
      },
      showPassword: false,
    }
  },

  methods: {
    async attemptRegistering() {
      try {
        this.isSaving = true
        await this.$axios.$get('sanctum/csrf-cookie')
        await this.$axios.$post('auth/register', {
          ...this.userDetails,
          full_name:
            this.userDetails.first_name + ' ' + this.userDetails.last_name,
        })

        await this.$auth.loginWith('sanctum', {
          data: {
            email: this.userDetails.email,
            password: this.userDetails.password,
          },
        })

        await this.$axios.$post('auth/email/verification-notification')

        this.$router.push('/')
        this.isSaving = false
        this.dialog = false
      } catch (error) {
        this.isSaving = false
        this.$kdal.error(error)
      }
    },
  },
}
</script>
