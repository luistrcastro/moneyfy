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
      return $axios.$get(`/${url}`, { params: options })
    },

    create(payload: object, args: object = {}) {
      return $axios.$post(`/${url}`, payload, args)
    },

    show(id: number) {
      return $axios.$get(`/${url}/${id}`, {})
    },

    update(payload: object, id: number) {
      return $axios.$put(`/${url}/${id}`, payload)
    },

    delete(id: number) {
      return $axios.$delete(`/${url}/${id}`)
    },
  })
