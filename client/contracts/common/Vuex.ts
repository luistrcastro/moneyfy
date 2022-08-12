/**
 * Defines a 'vuex' store object
 */
export default interface IVuex {
  commit: (a: string, b: object | string) => void
  dispatch: (a: string, b?: object) => void
  state: any
}
