import Vue from 'vue'
import Child from './Child.vue'
import { HasError, AlertError, AlertSuccess } from 'vform/components/bootstrap5'

import infopanelesuser from '~/components/infopanelesuser.vue'
// Components that are registered globaly.
[
  Child,
  HasError,
  AlertError,
  AlertSuccess,

  infopanelesuser,
].forEach(Component => {
  Vue.component(Component.name, Component)
})
