import IVuex from '~/contracts/common/Vuex'

export default ({ store }: { store: IVuex }, inject: any) => {
  inject('kdal', {
    error(error: { response: { data: { message: string } } }) {
      store.commit('kindAlert/SHOW_ALERT', {
        message: error.response.data.message,
        iconClass: 'shake',
        icon: 'error',
        iconColor: 'red',
      })
    },
    success(message: string) {
      store.commit('kindAlert/SHOW_ALERT', {
        message,
        iconClass: 'flip-scale-up-diag',
        icon: 'success',
        iconColor: 'green darken-1',
      })
    },
  })
}
