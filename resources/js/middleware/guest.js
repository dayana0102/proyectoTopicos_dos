import store from '~/store'

export default (to, from, next) => {
  if (store.getters['auth/check']) {
    //next({ name: 'home' })
    next( {name:store.getters['auth/firstRoute']})
  } else {
    next()
  }
}
