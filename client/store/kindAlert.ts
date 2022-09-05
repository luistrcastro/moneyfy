import { IKindAlertState } from '~/contracts/stores/KindAlert'

export const state: () => IKindAlertState = () => ({
  message: '',
  iconClass: '',
  icon: '',
  iconColor: '',
})

export const mutations = {
  SHOW_ALERT(
    state: IKindAlertState,
    {
      message,
      icon,
      iconClass,
      iconColor,
    }: { message: string; icon: string; iconClass: string; iconColor: string }
  ) {
    state.iconClass = iconClass
    state.message = message
    state.icon = icon
    state.iconColor = iconColor
  },
}
