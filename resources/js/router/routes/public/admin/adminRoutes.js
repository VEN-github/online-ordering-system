import { useAuthStore } from '@/store/auth/auth'

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
  }
]

export default routes
