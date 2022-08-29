<template>
  <v-snackbar
    v-model="show"
    :color="color"
    :left="left"
    :right="right"
    outlined
    :timeout="timeout"
  >
    {{ message }}
    <template #action="{ attrs }">
      <v-btn :color="color" text v-bind="attrs" @click="show = false">
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
export default {
  data() {
    return {
      color: '',
      left: false,
      message: '',
      position: '',
      right: false,
      show: false,
      timeout: 5000,
    }
  },

  created() {
    this.$store.subscribe((mutation, state) => {
      if (mutation.type === 'snackbar/SHOW_MESSAGE') {
        this.message = state.snackbar.content
        this.color = state.snackbar.color
        this.position = state.snackbar.position
        this.timeout = state.snackbar.timeout
        this.show = true
        this[state.snackbar.position] = true
        this.resetPosition()
      }
    })
  },

  methods: {
    resetPosition() {
      setTimeout(() => {
        this.position = ''
        this.left = false
        this.right = false
      }, this.timeout + 500)
    },
  },
}
</script>
