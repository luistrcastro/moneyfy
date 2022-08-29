<template>
  <div>
    <h1>Please verify your email</h1>
    <v-btn @click="sendEmail">Send Verification Email</v-btn>
  </div>
</template>

<script>
export default {
  mounted() {
    if (this.$store.state.auth.user.email_verified_at) {
      this.$router.push('/')
    }
  },

  methods: {
    async sendEmail() {
      try {
        await this.$api('auth/email/verification-notification').create()
        this.$notifier.showMessage({
          content: `Verification email sent to ${this.$store.state.auth.user.email}`,
          position: 'left',
          timeout: 4,
        })
      } catch (error) {
        this.$axiosError(error)
      }
    },
  },
}
</script>
