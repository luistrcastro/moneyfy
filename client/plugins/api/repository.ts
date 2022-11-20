import { IApi, IHttpClient } from '~/contracts/common/Http'

/**
 * Return a higher order function that gets injected into the application
 *
 * @param { HttpClient } $axios
 *
 * @return { function (url:string) }
 */
export default ($axios: IHttpClient) =>
  (url: string): IApi => ({
    index(options: object = {}) {
      return $axios.$get(`api/${url}`, { params: options })
    },

    post(payload: object, args: object = {}) {
      return $axios.$post(`api/${url}`, payload, args)
    },

    show(id: number) {
      return $axios.$get(`api/${url}/${id}`, {})
    },

    update(id: number, payload: object) {
      return $axios.$put(`api/${url}/${id}`, payload)
    },

    delete(id: number) {
      return $axios.$delete(`api/${url}/${id}`)
    },
  })
