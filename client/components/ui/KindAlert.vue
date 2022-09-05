<template>
  <v-dialog v-model="dialog" max-width="290">
    <v-card>
      <v-card-title class="mb-3 d-flex justify-center">
        <v-icon x-large :color="iconColor" :class="iconClass">{{
          displayIcon
        }}</v-icon>
      </v-card-title>

      <v-card-text>
        {{ message }}
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn v-if="false" color="green darken-1" text @click="dialog = false">
          Disagree
        </v-btn>

        <v-btn color="green darken-1" text @click="dialog = false"> Ok </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: 'KindAlert',
  data() {
    return {
      dialog: false,
      icon: '',
      iconClass: '',
      iconColor: '',
      message: '',
    }
  },

  computed: {
    displayIcon() {
      switch (this.icon) {
        case 'error':
          return 'mdi-close-circle-outline'
        default:
          return 'mdi-check-circle-outline'
      }
    },
  },

  created() {
    this.$store.subscribe((mutation, state) => {
      if (mutation.type === 'kindAlert/SHOW_ALERT') {
        this.iconClass = state.kindAlert.iconClass
        this.message = state.kindAlert.message
        this.dialog = true
        this.iconColor = state.kindAlert.iconColor
      }
    })
  },
}
</script>

<style scoped>
.shake {
  animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
  -webkit-animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
  transform: translate3d(0, 0, 0);
  backface-visibility: hidden;
  perspective: 1000px;
}
@keyframes shake {
  10%,
  90% {
    transform: translate3d(-1px, 0, 0);
  }

  20%,
  80% {
    transform: translate3d(2px, 0, 0);
  }

  30%,
  50%,
  70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%,
  60% {
    transform: translate3d(4px, 0, 0);
  }
}
@-webkit-keyframes shake {
  10%,
  90% {
    -webkit-transform: translate3d(-1px, 0, 0);
  }

  20%,
  80% {
    -webkit-transform: translate3d(2px, 0, 0);
  }

  30%,
  50%,
  70% {
    -webkit-transform: translate3d(-4px, 0, 0);
  }

  40%,
  60% {
    -webkit-transform: translate3d(4px, 0, 0);
  }
}

.flip-scale-up-diag {
  -webkit-animation: flip-scale-up-diag-1 0.5s linear both;
  animation: flip-scale-up-diag-1 0.5s linear both;
}
@-webkit-keyframes flip-scale-up-diag-1 {
  0% {
    -webkit-transform: scale(1) rotate3d(1, 1, 0, 0deg);
  }
  50% {
    -webkit-transform: scale(2.5) rotate3d(1, 1, 0, 90deg);
  }
  100% {
    -webkit-transform: scale(1) rotate3d(1, 1, 0, 0deg);
  }
}
@keyframes flip-scale-up-diag-1 {
  0% {
    transform: scale(1) rotate3d(1, 1, 0, 0deg);
  }
  50% {
    transform: scale(2.5) rotate3d(1, 1, 0, 90deg);
  }
  100% {
    transform: scale(1) rotate3d(1, 1, 0, 0deg);
  }
}
</style>
