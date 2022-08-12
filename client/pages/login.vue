<template>
  <div class="container is-fullheight">
    <div
      class="columns is-flex is-align-items-center is-centered is-mobile is-fullheight"
    >
      <div class="column is-two-thirds">
        <div class="card" style="opacity: 0.7">
          <div class="card-content p-6">
            <div class="has-text-centered">
              <!-- <img class="logo mb-2" src="~/assets/images/png/logo.png" /> -->
            </div>
            <v-text-field
              v-model="guest.email"
              :counter="10"
              label="Email"
              required
            />
            <v-text-field
              v-model="guest.password"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rulesPassword.required, rulesPassword.min]"
              :type="showPassword ? 'text' : 'password'"
              name="input-10-1"
              label="Normal with hint text"
              hint="At least 8 characters"
              counter
              @click:append="showPassword = !showPassword"
            />
            <v-btn class="is-primary mt-2" dusk="submit" @click="attemptLogin"
              >Submit</v-btn
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',
  auth: false,
  layout: 'guest',
  data: () => ({
    guest: {
      email: '',
      password: '',
    },
    showPassword: false,
    rulesPassword: {
      required: (value) => !!value || 'Required.',
      min: (v) => v.length >= 8 || 'Min 8 characters',
      emailMatch: () => `The email and password you entered don't match`,
    },
  }),

  methods: {
    /**
     * Reset the login form after a failed attempt
     */
    resetLoginForm() {
      this.guest.email = ''
      this.guest.password = ''

      this.$refs.loginForm.reset()

      // this.$buefy.toast.open({
      //   duration: 5000,
      //   message: `Invalid Credentials!`,
      //   position: 'is-bottom',
      //   type: 'is-danger',
      // })
    },
    /**
     * Validate and authorize provided credentials
     */
    async attemptLogin() {
      // if (!(await this.$refs.loginForm.validate())) return

      try {
        await this.$auth.loginWith('sanctum', {
          data: this.guest,
        })

        /**
         * NuxtAuth uses an 'auth' store and an $auth plugin to expose data
         * Since we want better control over these objects
         * we'll initialize a custom store and copy over the auth details
         */
        // this.$store.dispatch('user/set')

        this.$router.push('/')
      } catch (error) {
        this.resetLoginForm()
      }
    },
  },
}
</script>
