import { IHttpClient } from './Http'
import IVuex from './Vuex'

/**
 * Defines a 'context' object for use inside the Nuxt plugin
 */
export default interface INuxtContext {
  $appHelper: { deepClone: Function }
  $auth: object
  $axios: IHttpClient
  store: IVuex
}
