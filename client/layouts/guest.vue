<template>
  <v-app class="guest-page">
    <Nuxt />
    <SnackbarNotifier />
    <KindAlert />
    <v-img contain src="png/CAD-coin.png" class="home-logo" />
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
.home-logo {
  height: 100px;
  width: 100px;
  position: absolute;
  bottom: 20px;
  right: 20px;
  -webkit-animation: rotate-vert-center 2.5s linear infinite both;
  animation: rotate-vert-center 2.5s linear infinite both;
}
@-webkit-keyframes rotate-vert-center {
  0% {
    -webkit-transform: rotateY(0);
  }
  100% {
    -webkit-transform: rotateY(360deg);
  }
}
@keyframes rotate-vert-center {
  0% {
    transform: rotateY(0);
  }
  100% {
    transform: rotateY(360deg);
  }
}

.guest-page {
  height: 100vh;
  min-width: 100vw;
  background-color: #efefef;
  /* background-image: url('/jpeg/bg.guest.jpg'); */
  /* opacity: 0.7; */
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
</style>
