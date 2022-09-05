import IVuex from '~/contracts/common/Vuex'

export default ({ store }: { store: IVuex }, inject: any) => {
  inject('notifier', {
    showMessage({
      content = 'Update Successful',
      color = 'success',
      position = 'left',
      timeout = 5,
    }) {
      store.commit('snackbar/SHOW_MESSAGE', {
        content,
        color,
        position,
        timeout: timeout * 1000,
      })
    },
  })
}
 