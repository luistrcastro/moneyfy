export default function ({ store, route, redirect }) {
  // If the user's email is not yet verified
  if (
    route.name !== 'email-not-verified' &&
    route.name !== 'login' &&
    !store.state.auth.user.email_verified_at
  ) {
    return redirect('/email-not-verified')
  }
}
