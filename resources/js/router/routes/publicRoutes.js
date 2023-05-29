import { useAuthStore } from '@/store/auth/auth'

import HomeView from '@/views/client/HomeView.vue'

const routes = [
  {
    path: '/admin/login',
    name: 'admin-login',
    component: () => import('@/views/auth/AdminAuth.vue'),
    beforeEnter: (_, _2, next) => {
      const store = useAuthStore()
      if (!store.isAdminAuthenticated) {
        next()
      } else {
        next('/admin')
      }
    }
  },
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('@/views/client/AboutView.vue')
  }
]

export default routes
