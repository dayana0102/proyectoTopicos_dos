function page(path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', redirect: { name: 'home' } },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/home', name: 'home', component: page('home.vue') },

  // { path: '/home', name: 'home', component: page('home.vue') },

  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },
  {
    path: '/admin',
    component: page('admin/index.vue'),
    children: [
      { path: '', redirect: { name: 'users.admin' } },
      // { path: 'dashboard', name: 'dash.admin', component: page('admin/dashboard.vue') },
      { path: 'users', name: 'users.admin', component: page('admin/users.vue') },
      // { path: 'cursos', name: 'cursos.admin', component: page('admin/cursos.vue') },
      { path: 'paneles', name: 'paneles.admin', component: page('admin/paneles.vue') },
    ]
  },
  {
    path: '/escuela',
    component: page('escuela/index.vue'),
    children: [
      { path: '', redirect: { name: 'dash.escuela' } },
      { path: 'dashboard', name: 'dash.escuela', component: page('escuela/dashboard.vue') },
      { path: 'paneles', name: 'panel.escuela', component: page('escuela/paneles.vue') },
      { path: 'cursos', name: 'cursos.escuela', component: page('escuela/cursos.vue') },
      { path: 'docentes', name: 'docentes.escuela', component: page('escuela/controlDocentes.vue') },
    ]
  },
  {
    path: '/docente',
    component: page('docente/index.vue'),
    children: [
      { path: '', redirect: { name: 'dash.docente' } },
      { path: 'dashboard', name: 'dash.docente', component: page('docente/dashboard.vue') },
    ]
  },
  {
    path: '/alumno',
    component: page('alumno/index.vue'),
    children: [
      { path: '', redirect: { name: 'dash.alumno' } },
      { path: 'dashboard', name: 'dash.alumno', component: page('alumno/dashboard.vue') },
    ]
  },

  { path:'/panel', component:page('paneles/index.vue'),
    children:[
      { path: '', redirect:{ name:"inicio" } },
      { path: 'inicio', name: 'inicio', component: page('paneles/inicio.vue'), props:true },
      { path: 'board/:id', name: 'board', component: page('paneles/board.vue'), props:true },
    ]
  },

  { path: '*', component: page('errors/404.vue') },

  //PRUEBAS

  { path: '/prueba', name: 'prueba', component: page('pruebas/componenteA.vue') },
]
