<template>
  <v-app class="guest-page">
    <!-- <img src="/jpeg/bg.guest.jpg" class="guest-page" alt="" /> -->
    <Nuxt />
    <SnackbarNotifier />
    <KindAlert />
  </v-app>
</template>

<script>
import SnackbarNotifier from '~/components/ui/SnackbarNotifier.vue'
import KindAlert from '~/components/ui/KindAlert.vue'

export default {
  name: 'GuestLayout',
  components: { SnackbarNotifier, KindAlert },
}
</script>

<style scoped>
.guest-page {
  height: 100vh;
  min-width: 100vw;
  background-image: url('/jpeg/bg.guest.jpg');
  opacity: 0.7;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
</style>
