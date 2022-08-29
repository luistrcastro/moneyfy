import { ISnackbarState } from '~/contracts/stores/Snackbar'

export const state: () => ISnackbarState = () => ({
  color: '',
  content: '',
  position: '',
  timeout: 5000,
})

export const mutations = {
  SHOW_MESSAGE(
    state: ISnackbarState,
    payload: {
      content: string
      color: string
      position: string
      timeout: number
    }
  ) {
    state.content = payload.content
    state.color = payload.color
    state.position = payload.position
    state.timeout = payload.timeout
  },
}
