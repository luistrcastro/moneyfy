import Swal from 'sweetalert2'
import INuxtContext from '~/contracts/common/Nuxt'

export default (context: INuxtContext, inject: any) => {
  inject('axiosError', (error: { message: string }) => {
    // TODO: We may catch 401 (unauthorized) or other errors and provide a nice alert to the user
    if (error.message.includes('403')) {
      // @ts-ignore
      context.app.router.push('/noAccess')
      Swal.fire(
        'Forbidden',
        'You do not have permission for this operation.',
        'error'
      )
    } else {
      console.log(error)

      Swal.fire(
        'Whoops',
        `Something went wrong, please try again. \n Error: ${error.message}`,
        'warning'
      )
    }
  })
}
