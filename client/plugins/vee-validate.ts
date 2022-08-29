import { extend, localize } from 'vee-validate'
import { required, email, min } from 'vee-validate/dist/rules'

/**
 * Extend default rules like so:
 *
 * extend("required", {
 *  ---required,
 *  message: "This exotic piece of data is required bro!"
 * })
 */

/**
 * Extend all required rules in vee-validate
 * There is a way of importing all of them, but for now...
 * Being surgical reduces the total bundle size.
 */
extend('required', required)
extend('email', email)
extend('min', min)

localize({
  en: {
    messages: {
      required: 'The {_field_} field is required',
    },
  },
})
