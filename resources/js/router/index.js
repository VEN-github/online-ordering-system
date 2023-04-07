import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin',
      name: 'admin',
      component: () => import('../views/auth/AdminAuth.vue'),
      meta: {
        title: 'Admin',
        hideHomeNavbar: true
      }
    },
    {
      path: '/admin/login',
      name: 'admin-login',
      redirect: '/admin'
    },
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    }
  ]
})

const DEFAULT_TITLE = 'Online Ordering System'
router.beforeEach((to, _, next) => {
  next()
  document.title = to.meta.title || DEFAULT_TITLE
})

export default router
