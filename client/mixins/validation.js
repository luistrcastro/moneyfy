import { ValidationObserver } from 'vee-validate'

export default {
  components: {
    ValidationObserver,
  },
  methods: {
    validation() {
      return this.$refs.form.validate()
    },
  },
}
