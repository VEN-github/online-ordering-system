import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/store/auth'

import publicRoutes from './routes/publicRoutes'
import privateRoutes from './routes/privateRoutes'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [...publicRoutes, ...privateRoutes],
  linkActiveClass: 'active'
})

const DEFAULT_TITLE = 'Online Ordering System'
router.beforeEach((to, _, next) => {
  document.title = to.meta.title || DEFAULT_TITLE
  const store = useAuthStore()
  if (to.meta.requiresAuth && !store.isAdminAuthenticated) {
    next('/admin/login')
  } else {
    next()
  }
})

export default router
