/**
 * Defines the main HTTP Client library
 * ie axios
 */
export interface IHttpClient {
  $get(url: string, options: object): any
  $post(url: string, payload: object, args: object): any
  $put(url: string, payload: object): any
  $delete(url: string): any
}

/**
 * Defines the methods available to the this.$api([URL]) injected service
 */
export interface IApi {
  index: (options: object) => object
  post: (payload: object) => object
  show: (id: number) => object
  update: (id: number, payload: object) => object
  delete: (id: number) => object
}
