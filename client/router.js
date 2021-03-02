import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  { path: '/', name: 'welcome', component: page('index.vue') },
  { path: '/h-panel', name: 'h-panel', component: page('h-panel.vue') },
  { path: '/map', name: 'map', component: page('map.vue') },
  { path: '/search_result', name: 'search_result', component: page('search_result.vue') },


  { path: '/developers', name: 'developers', component: page('developers/index.vue') },
  { path: '/developers/developer', name: 'developers', component: page('developers/developer/index.vue') },
  { path: '/developers/developer/object', name: 'developers', component: page('developers/developer/object/index.vue') },
  {
    path: '/developers/developer/object/house',
    name: 'house',
    component: page('developers/developer/object/house/index.vue')
  },

  { path: '/parlament', name: 'parlament', component: page('parlament/developer_users.vue') },
  { path: '/parlament/area', name: 'parlament', component: page('parlament/area.vue') },
  { path: '/parlament/buildings', name: 'parlament', component: page('parlament/buildings.vue') },
  { path: '/parlament/developer_users', name: 'parlament', component: page('parlament/developer_users.vue') },

  { path: '/super_admin', name: 'super_admin', component: page('super_admin/add_object.vue') },
  { path: '/super_admin/add_object', name: 'super_admin', component: page('super_admin/add_object.vue') },
]

export function createRouter () {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
