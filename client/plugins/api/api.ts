import INuxtContext from '~/contracts/common/Nuxt'
import repository from '~/plugins/api/repository'

export default (context: INuxtContext, inject: any) => {
  /**
   * Inject API repositories into the application
   *
   * @example this.$api('users').post(UserObject)
   *
   * Please Note:
   * The 'users' in the above example is referencing a url
   * pre-pended with the baseUrl property set in nuxt.config.js in the axios section
   */

  inject('api', repository(context.$axios))
}
