import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/store/auth/auth'

import publicRoutes from './routes/public/publicRoutes'
import privateRoutes from './routes/private/privateRoutes'

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
